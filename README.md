#thinkphp6+vue2.6+element2.13 前后端分离落地解决方案

本人开发环境版本信息：
npm=6.13.4
vue =@vue/cli 4.1.2
node=v12.14.1


#注意1：vue-admin 中接口请求规则和动态路由，是对应tp6 中的接口规则和权限规则，需同时安装tp6和vue-admin 才能运行项目

#注意2：env 环境配置文件VUE_APP_BASE_API 接口地址，生产环境 或开发环境，需改变自己项目真实路径

#注意3：开发环境，如果使用代理，解决跨域问题，接口地址在  vue.config.js 设置代理proxy，转到http://127.0.0.1/index.php ，.env.development中的VUE_APP_BASE_API 设置空即可。

#注意4：如果只运行vue-admin前端，则可以把代理转到http://www.hardphp.com/index.php，先在本地跑起项目，在接口规则和动态路由，进行修改，适配自己的接口规则

#注意5：登录验证码，使用组件对think-captcha 进行修改，适用于前后端分离项目，composer require hardphp/think-captcha 进行安装，验证码存储基于redis，所以使用时确保redis服务可用

#注意6：如果开发遇到问题或需定制修改，可以向群友求助。


基于thinkphp6主要提供接口数据，实现功能主要包括：代码分层（model-->repository-->service-->middleware-->validate-->controller），接口规则，权限认证，文件上传（本地和阿里云），增删改查封装。主要使用thinkphp6的单应用模式，注解路由，中间件，事件，门面，服务等。

基于vue-admin-element，主要做后台管理界面，其中vue是2.6版本，element-ui 是2.13版本，实现功能主要包括：路由动态加载，axios 请求封装，接口规则封装，布局调整，通用列表，通用表单，通用增删改查功能封装。

体验地址:http://www.hardphp.com/backend/index.html 
账号admini，密码123456 即可。

说明文档
https://mp.weixin.qq.com/mp/homepage?__biz=MzUyNzI3OTQ2Nw==&hid=1&sn=6f734454a69c4cc3f8a28b9ed6f0e786&scene=126&clicktime=1585844155
![image](http://www.hardphp.com/1585845110.png)

接口文档
https://www.showdoc.cc/tp6vueadmin?page_id=4192966399826193

```
QQ交流群 :488148501
微信交流群：（由于群二维码有效期太短，加我微信，拉你入群,备注tp6-vue-admin）
```
![image](http://www.hardphp.com/895310371197138665.jpg)