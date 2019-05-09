<?php

namespace Psalm\Tests;

class PsalmInternalAnnotationTest extends TestCase
{
    use Traits\InvalidCodeAnalysisTestTrait;
    use Traits\ValidCodeAnalysisTestTrait;

    /**
     * @return iterable<string,array{string,assertions?:array<string,string>,error_levels?:string[]}>
     */
    public function providerValidCodeParse()
    {
        // commented out entries are not yet implemented
        return [
//            'internalMethodWithCall' => [
//                '<?php
//                    namespace A {
//                        class Foo {
//                            /**
//                             * @psalm-internal
//                             */
//                            public static function barBar(): void {
//                            }
//                        }
//                    }
//
//                    namespace A\B {
//                        class Bat {
//                            public function batBat() : void {
//                                \A\Foo::barBar();
//                            }
//                        }
//                    }',
//            ],
//            'internalClassWithStaticCall' => [
//                '<?php
//                    namespace A {
//                        /**
//                         * @psalm-internal
//                         */
//                        class Foo {
//                            public static function barBar(): void {
//                            }
//                        }
//                    }
//
//                    namespace A\B {
//                        class Bat {
//                            public function batBat() : void {
//                                \A\Foo::barBar();
//                            }
//                        }
//                    }',
//            ],
//            'internalClassExtendingNamespaceWithStaticCall' => [
//                '<?php
//                    namespace A {
//                        /**
//                         * @psalm-internal
//                         */
//                        class Foo extends \B\Foo {
//                            public function __construct() {
//                                parent::__construct();
//                            }
//                            public static function barBar(): void {
//                            }
//                        }
//                    }
//
//                    namespace B {
//                        class Foo {
//                            public function __construct() {
//                                static::barBar();
//                            }
//
//                            public static function barBar(): void {
//                            }
//                        }
//                    }',
//            ],
//            'internalClassWithNew' => [
//                '<?php
//                    namespace A {
//                        /**
//                         * @psalm-internal
//                         */
//                        class Foo { }
//                    }
//
//                    namespace A\B {
//                        class Bat {
//                            public function batBat() : void {
//                                $a = new \A\Foo();
//                            }
//                        }
//                    }',
//            ],
            'internalClassWithExtends' => [
                '<?php
                    namespace A\B {
                        /**
                         * @psalm-internal A\B
                         */
                        class Foo { }
                    }

                    namespace A\B\C {
                        class Bar extends \A\B\Foo {}
                    }',
            ],
//            'internalPropertyGet' => [
//                '<?php
//                    namespace A {
//                        class Foo {
//                            /**
//                             * @psalm-internal
//                             * @var ?int
//                             */
//                            public $foo;
//                        }
//                    }
//
//                    namespace A\B {
//                        class Bat {
//                            public function batBat() : void {
//                                echo (new \A\Foo)->foo;
//                            }
//                        }
//                    }',
//            ],
//            'internalPropertySet' => [
//                '<?php
//                    namespace A {
//                        class Foo {
//                            /**
//                             * @psalm-internal
//                             * @var ?int
//                             */
//                            public $foo;
//                        }
//                    }
//                    namespace A\B {
//                        class Bat {
//                            public function batBat() : void {
//                                $a = new \A\Foo;
//                                $a->foo = 5;
//                            }
//                        }
//                    }',
//            ],
//            'internalMethodInTraitWithCall' => [
//                '<?php
//                    namespace A {
//                        /**
//                         * @psalm-internal
//                         */
//                        trait T {
//                            public static function barBar(): void {
//                            }
//                        }
//
//                        class Foo {
//                            use T;
//
//                        }
//                    }
//
//                    namespace B {
//                        class Bat {
//                            public function batBat() : void {
//                                \A\Foo::barBar();
//                            }
//                        }
//                    }',
//            ],
        ];
    }

    /**
     * @return iterable<string,array{string,error_message:string,2?:string[],3?:bool,4?:string}>
     */
    public function providerInvalidCodeParse()
    {
        // commented out entries are not yet implemented
        return [
//            'internalMethodWithCall' => [
//                '<?php
//                    namespace A {
//                        class Foo {
//                            /**
//                             * @psalm-internal
//                             */
//                            public static function barBar(): void {
//                            }
//                        }
//                    }
//
//                    namespace B {
//                        class Bat {
//                            public function batBat() {
//                                \A\Foo::barBar();
//                            }
//                        }
//                    }',
//                'error_message' => 'InternalMethod',
//            ],
//            'internalClassWithStaticCall' => [
//                '<?php
//                    namespace A {
//                        /**
//                         * @psalm-internal
//                         */
//                        class Foo {
//                            public static function barBar(): void {
//                            }
//                        }
//                    }
//
//                    namespace B {
//                        class Bat {
//                            public function batBat() {
//                                \A\Foo::barBar();
//                            }
//                        }
//                    }',
//                'error_message' => 'InternalClass',
//            ],
//            'internalClassWithNew' => [
//                '<?php
//                    namespace A {
//                        /**
//                         * @psalm-internal
//                         */
//                        class Foo { }
//                    }
//
//                    namespace B {
//                        class Bat {
//                            public function batBat() {
//                                $a = new \A\Foo();
//                            }
//                        }
//                    }',
//                'error_message' => 'InternalClass',
//            ],
            'internalClassWithExtends' => [
                '<?php
                    namespace A\B {
                        /**
                         * @psalm-internal A\B
                         */
                        class Foo { }
                    }

                    namespace A\C {
                        class Bar extends \A\B\Foo {}
                    }',
                'error_message' => 'A\B\Foo is internal to A\B',
            ],
//            'internalPropertyGet' => [
//                '<?php
//                    namespace A {
//                        class Foo {
//                            /**
//                             * @psalm-internal
//                             * @var ?int
//                             */
//                            public $foo;
//                        }
//                    }
//
//                    namespace B {
//                        class Bat {
//                            public function batBat() : void {
//                                echo (new \A\Foo)->foo;
//                            }
//                        }
//                    }',
//                'error_message' => 'InternalProperty',
//            ],
//            'internalPropertySet' => [
//                '<?php
//                    namespace A {
//                        class Foo {
//                            /**
//                             * @psalm-internal
//                             * @var ?int
//                             */
//                            public $foo;
//                        }
//                    }
//                    namespace B {
//                        class Bat {
//                            public function batBat() : void {
//                                $a = new \A\Foo;
//                                $a->foo = 5;
//                            }
//                        }
//                    }',
//                'error_message' => 'InternalProperty',
//            ],
        ];
    }
}
