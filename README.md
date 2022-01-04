#thinkphp6+vue2.6+element2.13 前后端分离落地解决方案

# 第一、前端安装运行指南

#### 0、安装运行环境
前端推荐开发环境版本信息：
1、运行环境Nodejs 版本14.18.1 
2、开发工具Vs code 工具编码


#### 1、安装依赖包
```
npm install
```

安装慢的问题可以在根目录创建文件.npmrc,使用淘宝镜像，内容如下
```
sass_binary_site=https://npm.taobao.org/mirrors/node-sass/
registry=https://registry.npm.taobao.org
```

#### 2、本地运行
```
npm run serve
```

#### 3、编译代码包在backend 目录，直接放到网站跟目录库public 下
```
npm run build
```

#### 4、项目目录说明
```
src/api 接口地址配置
src/components 基础组件
src/router 固定路由地址，无须修改，动态路由是根据接口获得
src/utils 工具函数
src/views 界面视图代码

permission.js 权限处理文件 ，无须修改
setting.js 参数配置文件

.env.production 正式环境 编译时配置接口地址

vue.config.js 项目vue 配置文件  主要本地环境解决跨域的代理处理  proxy 下target 为接口地址
```

#### 5、 项目开发说明
```
1、src/api 创建接口地址
2、views 下创建模块目录，以article 为例
3、在views/article 创建列表文件 blog.vue，用户列表页面
列表页面主要包含以下几个模块
<!-- 搜索 -->搜索数据字段
<!-- 操作 -->刷新-搜索-添加-删除-批量状态处理
<!-- 表格 -->数据列表字段展示
<!-- 分页 -->
<!-- 表单 -->
<script> 部分主要是做 接口和组件引入，以及vue 初始化，函数操作等
 
4、 在views/article/blog 创建表单form 文件，用于添加和编辑数据页面
表单页面主要是字段展示编辑功能

5、article/blog 就是列表页面的路由地址
访问地址即是http://www.xxx.com/backend/#/article/blog
```

# 第二、项目运行指南
```
#注意1：vue-admin 中接口请求规则和动态路由，是对应tp6 中的接口规则和权限规则，需同时安装tp6和vue-admin 才能运行项目

#注意2：env 环境配置文件VUE_APP_BASE_API 接口地址，生产环境 或开发环境，需改变自己项目真实路径

#注意3：开发环境，如果使用代理，解决跨域问题，接口地址在  vue.config.js 设置代理proxy，转到http://127.0.0.1/index.php ，.env.development中的VUE_APP_BASE_API 设置空即可。

#注意4：如果只运行vue-admin前端，则可以把代理转到http://www.hardphp.com/index.php，先在本地跑起项目，在接口规则和动态路由，进行修改，适配自己的接口规则

#注意5：登录验证码，使用组件对think-captcha 进行修改，适用于前后端分离项目，composer require hardphp/think-captcha 进行安装，验证码存储基于redis，所以使用时确保redis服务可用

#注意6：如果开发遇到问题或需定制修改，可以向群友求助。
  ```

# 第二、项目后团接口运行指南
 ``` 
基于thinkphp6主要提供接口数据，实现功能主要包括：代码分层（model-->repository-->service-->middleware-->validate-->controller），接口规则，权限认证，文件上传（本地和阿里云），增删改查封装。主要使用thinkphp6的单应用模式，注解路由，中间件，事件，门面，服务等。

基于vue-admin-element，主要做后台管理界面，其中vue是2.6版本，element-ui 是2.13版本，实现功能主要包括：路由动态加载，axios 请求封装，接口规则封装，布局调整，通用列表，通用表单，通用增删改查功能封装。
```  
#### 程序开发说明，程序分四个层级，下层为上层服务，不建议跨层和平层调用，分层主要目的是为了代码复用
```
1、创建model文件
    关联数据表

2、创建repository文件

这层是数据层，主要对数据进行操作，可以使用 DB::name(table) ，也可以使用model , 关联查询建议使用DB join 方便， 不涉及太多逻辑处理

3、创建service文件

这层 主要逻辑层，如果service 中的一个方法涉及的逻辑太多，就进行拆分多个小逻辑，在controller 进行 整合调用。在service 不直接进行DB 或model 进行数据库的操作，通过repository 来提供数据操作能力 

4、创建controller 文件

参数接收判断， 整合调用多个service

#### 错误码使用
错误定义在config/error.php 中，禁止代码直接使用错误信息
```  
 
 ```

体验地址:http://www.hardphp.com/backend/index.html 
账号admini，密码123456 即可。

说明文档
https://mp.weixin.qq.com/mp/homepage?__biz=MzUyNzI3OTQ2Nw==&hid=1&sn=6f734454a69c4cc3f8a28b9ed6f0e786&scene=126&clicktime=1585844155
![image](http://www.hardphp.com/1585845110.png)

接口文档
https://www.showdoc.cc/tp6vueadmin?page_id=4192966399826193
```
```
QQ交流群 :488148501
微信交流群：（由于群二维码有效期太短，加我微信，拉你入群,备注tp6-vue-admin）
```
![image](http://www.hardphp.com/895310371197138665.jpg)
