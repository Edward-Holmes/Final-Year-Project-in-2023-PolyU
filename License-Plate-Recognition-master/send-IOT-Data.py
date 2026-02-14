import predict
import cv2
import socket
import RPi.GPIO as GPIO #导入GPIO库
import time #导入time库
from playsound import playsound

host = '10.12.0.167'
port = 8888

def takePicture():
	video = cv2.VideoCapture(0)     # 调用摄像头，PC电脑中0为内置摄像头，1为外接摄像头
	judge = video.isOpened()      # 判断video是否打开

	while judge:
		ret, frame = video.read()
		cv2.imshow("frame", frame)
		keyword = cv2.waitKey(1)
		if keyword == ord('q'):      # 按q退出
			isTake = False
			break

		elif keyword == ord('s'):     # 按s保存当前图片
			cv2.imwrite('./car_license/1.jpg', frame)
			print("图片已经保存")
			isTake = True
			break

	# 释放窗口
	video.release()
	cv2.destroyAllWindows()
	return isTake

def getIfconfig():
	"""
    查询本机ipv4地址
    return ip
    """
	try:
		s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
		s.connect(('8.8.8.8', 80))
		ip = s.getsockname()[0]
	finally:
		s.close()
	return ip

def recognize():
	haveTake = takePicture()
	if haveTake:
		car_license, license_color = predict.Output("./car_license/a.jpg")
		print("识别结果：", car_license, license_color)
		if len(car_license) == 0:
			car_license = "无车牌"
	else:
		print("照片未拍摄，正在退出程序")
		car_license = "未拍照"
	return car_license

def sendIOTData(message):  # 服务器IP、服务器端口号和发送的信息
	sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)  #以TCP协议模式进行通信
	sock.connect((host, port))         #连接到服务器
	msg=bytes(message, encoding = "utf8")   #将信号转为utf8编码
	sock.send(msg)                       #发送消息
	print("已发送信息：", message)
	sock.close()                             #关闭连接

def getIOTData():
	sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)  #以TCP协议模式进行通信
	sock.connect((host, port))         #连接到服务器
	data=sock.recv(1024)
	info = str(data, encoding="utf-8")                          
	print('接受到来自服务器的信息:',info)          #接收消息
	sock.close()
	return info

def duoji():
	rollPin = 24 #设定管脚
	GPIO.setmode(GPIO.BCM) #设定编码模式
	GPIO.setup(rollPin,GPIO.OUT) #将GPIO23设置为输出口
	p = GPIO.PWM(rollPin,50) #创建一个PWM实例
	p.start(0) #开始
	try:
		p.ChangeDutyCycle(7.5) #更改占空比，控制旋转角度
		time.sleep(0.5) #休息
		p.ChangeDutyCycle(0) #更改占空比，控制旋转角度
		time.sleep(3.5) #休息
		p.ChangeDutyCycle(2.5)#反转
		time.sleep(0.5)
	except KeyboardInterrupt: #自动跳过有问题的地方，保障程序不被弹出
		p.stop() #停止工作
	GPIO.cleanup() #清除端口数据

if __name__ == '__main__':
	ipaddress = getIfconfig()
	while True:
		getCarLicense = recognize()
		sendIOTData(ipaddress)
		sendIOTData(getCarLicense)
		canopen=getIOTData()
		if canopen=='True':
			playsound("./Audio/True.mp3")
			duoji()
		else:
			playsound("./Audio/False.mp3")