Assetic issue
========================

This is demonstration of Assetic issue, based on Symfony standard edition.

+ there's a template (`@AcmeDemoBundle:Welcome:index.html.twig`)
+ template reference stylesheet with a variable (`{theme}`) in path
+ stylesheet contains image with relative path
+ there is CssRewrite filter applied to that stylesheet
+ when running `assetic:dump`, file `web/compiled/foo.css` is generated
+ generated file contains relative path of image which is messed up (contains variable): `background-image: url("../../bundles/acmedemo/css/themes/{theme}/images/bg.jpg");`

There's a way to suppress this issue by replacing last line in `\Assetic\Filter\CssRewriteFilter`:

```PHP
$asset->setContent($content, $asset->getVars(), $asset->getValues());
```
with
```PHP
$asset->setContent(
	VarUtils::resolve($content, $asset->getVars(), $asset->getValues())
);
```
but this looks rather like hack then like fix


Long story short
========================
```
composer install
php app/console assetic:dump
cat web/compiled/foo.css
```
