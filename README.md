# Doya File Server

tip:

本服务用php开发文件上传和删除的server。利用nginx代理静态文件。

## Docker

本系统可通过Docker进行部署。

Dockerfile可在当前目录下查看

docker-compose.yml在docker目录下，主要用于整合nginx和php server。

.env 中2个环境变量的意思如下：

```ini
# 保存的文件路径(宿主机)，用于上传的文件持久化保存以及让nginx可以访问
FILE_PATH
# nginx配置目录
NGINX_CONF_PATH
```

在 docker > nginx-config 目录下，有一个默认的nginx配置文件，如果没有特殊需求，直接使用此配置文件即可

使用该配置的nginx，可以直接使用文件名访问到文件，示例如下：

```
1. http://vpn.doya.fun:10101/20220530-d7949da17584d1c3251721e3fb9720254596.png
2. http://vpn.doya.fun:10101/files/20220530/20220530-d7949da17584d1c3251721e3fb9720254596.png
# 可以使用第一条url访问到第二条url的文件
```



## Api

### 接口列表

| 接口                              | 说明     |
| --------------------------------- | -------- |
| [/api/files(post)](#fileStore)    | 上传文件 |
| [/api/files(delete)](#fileDelete) | 删除文件 |

### 错误码列表

| 错误码 | 说明 |
| ------ | ---- |
| 0      | 成功 |
| -1     | 失败 |



### 接口详情

#### <span id="fileStore">上传文件</span>

* 接口地址：/api/files
* 返回格式：Json
* 请求方式：POST
* 接口备注：上传多个文件，并返回对应的上传状态和保存的文件名
* 请求参数说明：

| 名称                   | 类型 | 必填 | 说明                       |
| ---------------------- | ---- | ---- | -------------------------- |
| file(名称随意，可多个) | 文件 | true | 要上传的文件，可有多个参数 |

* 返回参数说明：

| 名称     | 类型   | 说明     |
| -------- | ------ | -------- |
| filename | string | 文件名称 |

* JSON返回示例

```json
{
    "code": 0,
    "msg": "success",
    "data": {
        "file": {
            "code": 0,
            "msg": "store success",
            "data": {
                "filename": "20220530-4cd67a08abbd5e7b6aec3fb86a603bfa9185.png"
            }
        },
        "file2": {
            "code": -1,
            "msg": "xxxxxxxxxxxxxxxxxxxx"
        }
    }
}
```

#### <span id="fileDelete">删除文件</span>

* 接口地址：/api/file/{name}
* 返回格式：Json
* 请求方式：DELETE
* 接口备注：删除文件
* 请求参数说明：

| 名称 | 类型   | 必填 | 说明           |
| ---- | ------ | ---- | -------------- |
| name | string | true | 要删除的文件名 |
