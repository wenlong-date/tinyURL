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
- [ ] Test Report (read and write QPS)