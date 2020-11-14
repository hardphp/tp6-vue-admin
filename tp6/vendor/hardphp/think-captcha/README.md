# hardphp/think-captcha

thinkphp6 接口验证码类库

## 安装
> composer require hardphp/think-captcha



## 使用

### 在控制器中输出验证码

在控制器的操作方法中使用

~~~
public function captcha($id = '')
{
	return captcha($id);
}
~~~
然后注册对应的路由来输出验证码


### 输出验证码

注册一个验证码路由规则。

~~~
\think\facade\Route::get('captcha/[:id]', "\\hardphp\\captcha\\CaptchaController@index");
~~~

### 控制器里验证

使用TP的内置验证功能即可,验证码格式key-value
~~~
$this->validate($data,[
    'captcha|验证码'=>'require|captcha'
]);
~~~
或者手动验证
~~~
if(!captcha_check($key,$captcha)){
 //验证失败
};
~~~