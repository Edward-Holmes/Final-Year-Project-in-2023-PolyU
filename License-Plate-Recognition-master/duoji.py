import RPi.GPIO as GPIO #导入GPIO库
import time #导入time库
rollPin = 24 #设定管脚
GPIO.setmode(GPIO.BCM) #设定编码模式
GPIO.setup(rollPin,GPIO.OUT) #将GPIO23设置为输出口
p = GPIO.PWM(rollPin,50) #创建一个PWM实例
p.start(0) #开始
try:
    p.ChangeDutyCycle(7.5) #更改占空比，控制旋转角度
    time.sleep(0.5) #休息
    p.ChangeDutyCycle(0) #更改占空比，控制旋转角度
    time.sleep(5.5) #休息
    p.ChangeDutyCycle(2.5)#反转
    time.sleep(0.5)
except KeyboardInterrupt: #自动跳过有问题的地方，保障程序不被弹出
    p.stop() #停止工作
GPIO.cleanup() #清除端口数据