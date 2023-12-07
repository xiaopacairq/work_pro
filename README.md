# 智慧作业管理使用手册

> 1. 测试网站：
>
> 学生端访问：http://works_pro.srqcode.com/student/login (默认班级编号：2005 账号：201120184 密码：123456)
>
> 教师端访问：http://works_pro.srqcode.com/teacher/login (默认 账号：admin 密码：admin )

# 智慧作业管理系统重构

### 优化内容如下

- [x] 核心逻辑交给 business
- [x] 数据层逻辑交给 model，按照数据表创建类
- [x] 错误统一返回 json，并配置 config 错误代码
- [x] 验证器 validate 统一校验数据层
- [x] 表单令牌 token 禁止重复提交
- [x] token 取代 session 登录
- [x] 聚合 ip 接口，获取登录信息
- [x] auth 中间件，实时监控 token，过期退出
- [x] 采用强制路由，提升网站控制器安全性

- [ ] 防盗链技术

> 时间 ：12 月 1 日-12 月 7 日
> 重构代码量如下表

## Languages

| language | files |  code | comment | blank | total |
| :------- | ----: | ----: | ------: | ----: | ----: |
| PHP      |    88 | 5,679 |     832 |   917 | 7,428 |

## Directories

| path                     | files |  code | comment | blank | total |
| :----------------------- | ----: | ----: | ------: | ----: | ----: |
| .                        |    88 | 5,679 |     832 |   917 | 7,428 |
| . (Files)                |     9 |   160 |      88 |    42 |   290 |
| admin                    |    34 | 2,711 |     196 |   344 | 3,251 |
| admin (Files)            |     1 |     5 |       7 |     1 |    13 |
| admin\\controller        |     7 |   801 |     128 |   175 | 1,104 |
| admin\\middleware        |     1 |    27 |       4 |    12 |    43 |
| admin\\route             |     7 |    40 |      22 |    18 |    80 |
| admin\\view              |    18 | 1,838 |      35 |   138 | 2,011 |
| admin\\view (Files)      |     1 |    82 |       0 |    10 |    92 |
| admin\\view\\account     |     1 |   109 |       3 |     7 |   119 |
| admin\\view\\classes     |     4 |   544 |       8 |    38 |   590 |
| admin\\view\\home        |     1 |    76 |       0 |     3 |    79 |
| admin\\view\\public      |     2 |   119 |       2 |    15 |   136 |
| admin\\view\\score       |     1 |    59 |       1 |     3 |    63 |
| admin\\view\\stu         |     4 |   445 |      13 |    31 |   489 |
| admin\\view\\work        |     4 |   404 |       8 |    31 |   443 |
| common                   |    23 | 1,464 |     454 |   334 | 2,252 |
| common\\business         |     9 |   949 |     193 |   205 | 1,347 |
| common\\business\\admin  |     5 |   673 |     136 |   132 |   941 |
| common\\business\\common |     1 |     5 |       3 |     4 |    12 |
| common\\business\\home   |     3 |   271 |      54 |    69 |   394 |
| common\\model            |     9 |   372 |     171 |   104 |   647 |
| common\\validate         |     5 |   143 |      90 |    25 |   258 |
| common\\validate\\admin  |     4 |   120 |      72 |    20 |   212 |
| common\\validate\\home   |     1 |    23 |      18 |     5 |    46 |
| home                     |    22 | 1,344 |      94 |   197 | 1,635 |
| home (Files)             |     1 |     5 |       7 |     1 |    13 |
| home\\controller         |     5 |   360 |      51 |    90 |   501 |
| home\\middleware         |     1 |    36 |       5 |    13 |    54 |
| home\\route              |     5 |    23 |      15 |    14 |    52 |
| home\\view               |    10 |   920 |      16 |    79 | 1,015 |
| home\\view (Files)       |     1 |    82 |       0 |    10 |    92 |
| home\\view\\account      |     1 |   112 |       3 |     8 |   123 |
| home\\view\\dis_work     |     3 |   244 |       2 |    22 |   268 |
| home\\view\\home         |     1 |    59 |       0 |     1 |    60 |
| home\\view\\public       |     2 |   107 |       2 |    12 |   121 |
| home\\view\\up_work      |     2 |   316 |       9 |    26 |   351 |
