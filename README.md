# tinyURL
achieve tinyURL based on leetcode

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