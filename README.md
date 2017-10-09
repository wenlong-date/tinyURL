# tinyURL
achieve tinyURL based on leetcode

## DEMO
1. Request `http://tinyurl.wenlong.date/000001` to get the example function

2. Use Chrome Browser Console Command To Request Test;
```
var data = {url: 'https://www.google.com'};
fetch('http://tinyurl.wenlong.date', {method:'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify(data)}).then(r=>r.json()).then(d=>console.log(d));
```
then you can get
```
{state: true, data: "http://tinyurl.wenlong.date/000003"}
```
then you can request `http://tinyurl.wenlong.date/000003` to get what you had saved url

## use
**APIs**

**1.get shorter url**
>method

POST

>URL

`http://yourdomain/`

>parameter

| 字段        | 类型     | 是否必须 | 默认值   | 参考值                                      | 说明         |
| :-------- | :----- | :--- | :---- | :-------- | :--------- |
| url      | string | yes   | null |null | 需要转换的长链接  |

> 返回参数

```json
{
    "state": true,
    "data": "http://tinyurldomanin/000007"
}
```

**2.get original url**
>method

GET

>URL

`http://yourdomain/{tinyurl}`

>parameter

NUll

> 返回302 redirect

## TODO
- [x] Basic function
- [ ] Use Redis
- [ ] Request Auth
- [x] Test Report (read and write QPS)


## AB TEST
>4 core/2.2G Hz/16G memory/Intel Core Processor (Broadwell)
>centos 6.9; nginx 1.10.2; php 7.1.4; lumen 5.5.0; mysql 5.1.73;

###not use redis
**Read QPS**
1.`ab -n 1000 -c 10  tinyurl.wenlong.date/001`
**108 QPS**

2.`ab -n 100 -c 10 -T 'application/x-www-form-urlencoded' -p data.txt 'http://tinyurl.wenlong.date/'`
**104 QPS**

data.txt file
```
url=test
```


## QUESTIONs
- 短链接的地址会根据其位数不断增加，六位的短地址能够支持`56,800,235,584(62^6)`的短地址，十位的短地址能够支持`839,299,365,868,340,200(62^10)`的短地址，理论上够用。
- 参考一些短链接的设计方案，使用62进制进行设计比较容易。
- 使用DB和Redis缓存进行保存和查询

## REFERENCE
- https://www.zhihu.com/question/29270034
- https://discuss.leetcode.com/topic/95853/a-complete-solution-for-tinyurl-leetcode-system-design