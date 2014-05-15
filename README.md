Yii2-PDF
========

PDF formatter for Yii2 using mPDF library

This extension "format" HTML responses to PDF files (by default Yii2 includes HTML, JSON and XML formatters). Great for reporting in PDF format using HTML views/layouts.

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
