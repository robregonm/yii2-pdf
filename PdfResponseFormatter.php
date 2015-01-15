<?php
/**
 *
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @created 15/05/14 12:35 PM
 */

namespace robregonm\pdf;

use Yii;
use yii\base\Component;
use yii\web\Response;
use yii\web\ResponseFormatterInterface;

/**
 * PdfResponseFormatter formats the given HTML data into a PDF response content.
 *
 * It is used by [[Response]] to format response data.
 *
 * @author Ricardo Obregón <robregonm@gmail.com>
 * @since 2.0
 */
class PdfResponseFormatter extends Component implements ResponseFormatterInterface
{
	public $mode = '';

	public $format = 'A4';

	public $defaultFontSize = 0;

	public $defaultFont = '';

	public $marginLeft = 15;

	public $marginRight = 15;

	public $marginTop = 16;

	public $marginBottom = 16;

	public $marginHeader = 9;

	public $marginFooter = 9;

	/**
	 * @var string 'Landscape' or 'Portrait'
	 * Default to 'Portrait'
	 */
	public $orientation = 'P';

	public $options = [];

	/**
	 * @var Closure function($mpdf, $data){}
	 */
	public $beforeRender;

	/**
	 * Formats the specified response.
	 *
	 * @param Response $response the response to be formatted.
	 */
	public function format($response)
	{
		$response->getHeaders()->set('Content-Type', 'application/pdf');
		$response->content = $this->formatPdf($response);
	}

	/**
	 * Formats response HTML in PDF
	 *
	 * @param Response $response
	 */
	protected function formatPdf($response)
	{
		$mpdf = new \mPDF($this->mode,
			$this->format,
			$this->defaultFontSize,
			$this->defaultFont,
			$this->marginLeft,
			$this->marginRight,
			$this->marginTop,
			$this->marginBottom,
			$this->marginHeader,
			$this->marginFooter,
			$this->orientation
		);

		foreach ($this->options as $key => $option) {
			$mpdf->$key = $option;
		}

		if ($this->beforeRender instanceof \Closure) {
			call_user_func($this->beforeRender, $mpdf, $response->data);
		}

		$mpdf->WriteHTML($response->data);
		return $mpdf->Output('', 'S');
	}
}
