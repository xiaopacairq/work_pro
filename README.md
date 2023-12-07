# 智慧作业管理系统重构

> 12 月 1 日-12 月 4 日 20 个小时完成
>
> 优化内容如下

- [x] 核心逻辑交给 business
- [x] 数据层逻辑交给 model，按照数据表创建逻辑
- [x] 错误统一返回 json，并配置 config 错误代码
- [x] 验证器校验数据层
- [x] 表单令牌 token 禁止重复提交
- [x] token 取代 session 登录
- [x] 聚合 ip 接口，获取登录信息
- [x] auth 中间件，实时监控 token，过期退出
- [x] 采用强制路由，提升网站控制器安全性

- [ ] 验证器验证 excel 格式
- [ ] 防盗链技术
