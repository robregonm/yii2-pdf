Yii2-PDF
========

PDF formatter for Yii2 using mPDF library.

This extension "format" HTML responses to PDF files (by default Yii2 includes HTML, JSON and XML formatters). Great for reports in PDF format using HTML views/layouts.

##Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require robregonm/yii2-pdf "dev-master"
```

or add

```
"robregonm/yii2-pdf": "dev-master"
```

to the require section of your `composer.json` file.

## Usage

Once the extension is installed, modify your application configuration to include:

```php
return [
	'components' => [
		...
		'response' => [
			'formatters' => [
				'pdf' => [
					'class' => 'robregonm\pdf\PdfResponseFormatter',
					'rotated' => false,
				],
			]
		],
		...
	],
];
```

In the controller:

```php

class MyController extends Controller {
	public function actionPdf(){
		Yii::$app->response->format = 'pdf';
		
		//Can you it if needed to rotate the page
		Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], ['rotated' => true]);
		
		$this->layout = '//print';
		return $this->render('myview', []);
	}
}

```

## License

Yii2-Pdf is released under the BSD-3 License. See the bundled `LICENSE.md` for details.


# Useful URLs

* [mPDF Manual](http://mpdf1.com/manual/index.php)

Enjoy!

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=robregonm&url=https://github.com/robregonm/yii2-pdf&title=Yii2-PDF&language=&tags=github&category=software) 
