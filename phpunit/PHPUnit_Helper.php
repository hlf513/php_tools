<?php

/**
 * PHPUnit_Helper.php
 *
 * phpunit断言提示类
 *
 * @copyright longfei.he
 * @author    longfei.he <hlf513@gmail.com>
 */
class PHPUnit_Framework_TestCase
{
	/**
	 * @param string $key
	 * @param array  $array
	 * @param string $message 提示信息
	 */
	 public function assertArrayHasKey($key, array $array, $message = ''){}

	 public function assertArrayNotHasKey($key, array $array, $message = ''){}

	/**
	 * @param string $attributeName
	 * @param string $className
	 * @param string $message
	 */
	 public function assertClassHasAttribute($attributeName, $className, $message = ''){}

	 public function assertClassNotHasAttribute($attributeName, $className, $message = ''){}

	/**
	 * 子集判断
	 *
	 * @param array  $subset
	 * @param array  $array
	 * @param bool   $strict 是否全等判定
	 * @param string $message
	 */
	 public function assertArraySubset(array $subset, array $array, $strict = '', $message = ''){}

	/**
	 * 类静态属性
	 *
	 * @param string $attributeName
	 * @param string $className
	 * @param string $message
	 */
	 public function assertClassHasStaticAttribute($attributeName, $className, $message = ''){}

	 public function assertClassNotHasStaticAttribute($attributeName, $className, $message = ''){}

	/**
	 * 包含
	 *
	 * @param mixed          $needle
	 * @param Iterator|array $haystack
	 * @param string         $message
	 * $param bool           $ignoreCase false是大小写敏感
	 */
	 public function assertContains($needle, array $haystack, $message = '', $ignoreCase = false){}

	 public function assertNotContains($needle, array $haystack, $message = ''){}

	/**
	 * 判断类的属性
	 *
	 * 可判断public,protected,private
	 *
	 * @param mixed          $needle
	 * @param Iterator|array $haystack
	 * @param string         $message
	 */
	 public function assertAttributeContains($needle, array $haystack, $message = ''){}

	 public function assertAttributeNotContains(){}


	/**
	 * @param string         $type
	 * @param Iterator|array $haystack
	 * @param bool           $isNativeType 表明$type是否是原生php类型
	 * @param string         $message
	 */
	 public function assertContainsOnly($type, $haystack, $isNativeType = null, $message = ''){}

	 public function assertNotContainsOnly($type, $haystack, $isNativeType = null, $message = ''){}

	/**
	 * 判断类的属性
	 *
	 * 可判断public,protected,private
	 *
	 * @param string         $type
	 * @param Iterator|array $haystack
	 * @param bool           $isNativeType 表明$type是否是原生php类型
	 * @param string         $message
	 */
	 public function assertAttributeContainsOnly($type, $haystack, $isNativeType = null, $message = ''){}

	 public function assertAttributeNotContainsOnly($type, $haystack, $isNativeType = null, $message = ''){}

	/**
	 * 是否只包含$classname实例
	 *
	 * @param string            $classname
	 * @param Traversable|array $haystack
	 * @param string            $message
	 */
	 public function assertContainsOnlyInstancesOf($classname, $haystack, $message = ''){}

	/**
	 * @param int    $expectedCount
	 * @param array  $haystack
	 * @param string $message
	 */
	 public function assertCount($expectedCount, $haystack, $message = ''){}

	 public function assertNotCount($expectedCount, $haystack, $message = ''){}

	/**
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertEmpty($actual, $message = ''){}

	 public function assertNotEmpty($actual, $message = ''){}

	/**
	 * 判断类的属性是否为空
	 *
	 * 可判断public protected private
	 *
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertAttributeEmpty($actual, $message = ''){}

	 public function assertAttributeNotEmpty($actual, $message = ''){}

	/**
	 * @param \DOMElement $expectedElement
	 * @param \DOMElement $actualElement
	 * @param bool        $checkAttributes
	 * @param string      $message
	 */
	 public function assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, $checkAttributes = false, $message = ''){}


	/**
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertEquals($expected, $actual, $message = ''){}

	 public function assertNotEquals($expected, $actual, $message = ''){}

	/**
	 * 判断类的属性是否相等
	 *
	 * 可判断public protected private
	 *
	 * @param        $expected
	 * @param        $actual
	 * @param string $message
	 */
	 public function assertAttributeEquals($expected, $actual, $message = ''){}

	 public function assertAttributeNotEquals($expected, $actual, $message = ''){}

	/**
	 * @param bool   $condition
	 * @param string $message
	 */
	 public function assertFalse($condition, $message = ''){}

	 public function assertNotFalse($condition, $message = ''){}

	/**
	 * 判断文件内容是否相同
	 *
	 * @param string $expected
	 * @param string $actual
	 * @param string $message
	 */
	 public function assertFileEquals($expected, $actual, $message = ''){}

	 public function assertFileNotEquals($expected, $actual, $message = ''){}

	/**
	 * @param string $filename
	 * @param string $message
	 */
	 public function assertFileExists($filename, $message = ''){}

	 public function assertFileNotExists($filename, $message = ''){}

	/**
	 * 不小于
	 *
	 * @param  mixed $expected
	 * @param  mixed $actual
	 * @param string $message
	 */
	 public function assertGreaterThan($expected, $actual, $message = ''){}

	/**
	 * 判断类的属性
	 *
	 * 判断public protected private
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertAttributeGreaterThan($expected, $actual, $message = ''){}

	/**
	 * 不大于
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertGreaterThanOrEqual($expected, $actual, $message = ''){}

	/**
	 * 判断类的属性
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertAttributeGreaterThanOrEqual($expected, $actual, $message = ''){}

	/**
	 * 判断是不是inf
	 *
	 * @param mixed  $variable
	 * @param string $message
	 */
	 public function assertInfinite($variable, $message = ''){}

	 public function assertFinite($variable, $message = ''){}

	/**
	 * @param object $expected
	 * @param object $actual
	 * @param string $message
	 */
	 public function assertInstanceOf($expected, $actual, $message = ''){}

	 public function assertNotInstanceOf($expected, $actual, $message = ''){}

	/**
	 * 指定类型
	 *
	 * 当 $actual 不是 $expected 类型时报错
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertInternalType($expected, $actual, $message = ''){}

	 public function assertNotInternalType($expected, $actual, $message = ''){}

	/**
	 * 判断类的类型
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertAttributeInternalType($expected, $actual, $message = ''){}

	 public function assertAttributeNotInternalType($expected, $actual, $message = ''){}

	/**
	 * 判断json文件是否相同
	 *
	 * @param mixed  $expectedFile
	 * @param mixed  $actualFile
	 * @param string $message
	 */
	 public function assertJsonFileEqualsJsonFile($expectedFile, $actualFile, $message = ''){}

	/**
	 * 判断json文件和json字符串是否相同
	 *
	 * @param mixed  $expectedFile
	 * @param mixed  $actualFile
	 * @param string $message
	 */
	 public function assertJsonStringEqualsJsonFile($expectedFile, $actualJson, $message = ''){}

	/**
	 * 判断json字符串是否相同
	 *
	 * @param mixed  $expectedJson
	 * @param mixed  $actualJson
	 * @param string $message
	 */
	 public function assertJsonStringEqualsJsonString($expectedJson, $actualJson, $message = ''){}

	/**
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertLessThan($expected, $actual, $message = ''){}

	/**
	 * 判断类的属性小于
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertAttributeLessThan($expected, $actual, $message = ''){}

	/**
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertLessThanOrEqual($expected, $actual, $message = ''){}

	/**
	 * 判断类的属性小于等于
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertAttributeLessThanOrEqual($expected, $actual, $message = ''){}

	/**
	 * @param mixed  $variable
	 * @param string $message
	 */
	 public function assertNan($variable, $message = ''){}

	/**
	 * @param mixed  $variable
	 * @param string $message
	 */
	 public function assertNull($variable, $message = ''){}

	/**
	 * @param string $attributeName
	 * @param object $object
	 * @param string $message
	 */
	 public function assertObjectHasAttribute($attributeName, $object, $message = ''){}

	 public function assertObjectNotHasAttribute($attributeName, $object, $message = ''){}

	/**
	 * @param string $pattern
	 * @param string $string
	 * @param string $message
	 */
	 public function assertRegExp($pattern, $string, $message = ''){}

	 public function assertNotRegExp($pattern, $string, $message = ''){}

	/**
	 * 格式匹配
	 *
	 * %s  =>  'abc'
	 *
	 * @param string $format
	 * @param string $string
	 * @param string $message
	 */
	 public function assertStringMatchesFormat($format, $string, $message = ''){}

	 public function assertStringNotMatchesFormat($format, $string, $message = ''){}

	/**
	 * 正则文件匹配
	 *
	 * @param string $formatFile
	 * @param string $string
	 * @param string $message
	 */
	 public function assertStringMatchesFormatFile($formatFile, $string, $message = ''){}

	 public function assertStringNotMatchesFormatFile($formatFile, $string, $message = ''){}

	/**
	 * 是否一样
	 *
	 * 类型判断,相同引用
	 *
	 * @param mixed  $expected
	 * @param mixed  $actual
	 * @param string $message
	 */
	 public function assertSame($expected, $actual, $message = ''){}

	 public function assertNotSame($expected, $actual, $message = ''){}

	/**
	 * 类的属性是否一样
	 *
	 * @param        $expected
	 * @param        $actual
	 * @param string $message
	 */
	 public function assertAttributeSame($expected, $actual, $message = ''){}

	 public function assertAttributeNotSame($expected, $actual, $message = ''){}

	/**
	 * 判读字符串结尾
	 *
	 * @param string $suffix
	 * @param string $string
	 * @param string $message
	 */
	 public function assertStringEndsWith($suffix, $string, $message = ''){}

	 public function assertStringEndsNotWith($suffix, $string, $message = ''){}

	/**
	 * 判断文件内容
	 *
	 * @param string $expectedFile
	 * @param string $actualString
	 * @param string $message
	 */
	 public function assertStringEqualsFile($expectedFile, $actualString, $message = ''){}

	 public function assertStringNotEqualsFile($expectedFile, $actualString, $message = ''){}

	/**
	 * 判断字符串开头
	 *
	 * @param string $prefix
	 * @param string $string
	 * @param string $message
	 */
	 public function assertStringStartsWith($prefix, $string, $message = ''){}

	 public function assertStringStartsNotWith($prefix, $string, $message = ''){}

	/**
	 * @param bool $condition
	 */
	 public function assertTrue($condition, $message = ''){}

	 public function assertNotTrue($condition, $message = ''){}

	/**
	 * @param string $expectedFile
	 * @param string $actualFile
	 * @param string $message
	 */
	 public function assertXmlFileEqualsXmlFile($expectedFile, $actualFile, $message = ''){}

	 public function assertXmlFileNotEqualsXmlFile($expectedFile, $actualFile, $message = ''){}

	/**
	 * @param string $expectedFile
	 * @param string $actualXml
	 * @param string $message
	 */
	 public function assertXmlStringEqualsXmlFile($expectedFile, $actualXml, $message = ''){}

	 public function assertXmlStringNotEqualsXmlFile($expectedFile, $actualXml, $message = ''){}

	/**
	 * @param string $expectedXml
	 * @param string $actualXml
	 * @param string $message
	 */
	 public function assertXmlStringEqualsXmlString($expectedXml, $actualXml, $message = ''){}

	 public function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, $message = ''){}
}
