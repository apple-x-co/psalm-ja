# 初期化されていないプロパティ

プロパティが初期化される前にコンストラクタで使用された場合に発行されます。

```php
<?php

class A {
    /** @var string */
    public $foo;

    public function __construct() {
        echo strlen($this->foo);
        $this->foo = "foo";
    }
}
```
