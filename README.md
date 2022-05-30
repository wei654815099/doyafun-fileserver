# Doya File Server

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
