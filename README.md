<h1 align="center"> distributedlock </h1>

<p align="center"> .</p>

## Usage

#### 通过redis实现的简单分布式锁

> 原理

1. 通过redis的setnx设置一个时间戳
2. 通过getset解决死锁问题

> 注意

加锁时候必须设置一个时间戳

#### 声明
代码只是原理探究，生产环境请酌情使用。

## License

MIT