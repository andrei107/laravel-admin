<?php

namespace App\Services;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Settings;

class PhpExcelService
{
    /**
     * The PHPExcel object instance.
     */
    private $objPHPExcel;

    private $format;

    private $rowLevel = 1;

    public function __construct($format)
    {
        if (!$this->isAllowedFormat($format)) {
            throw new \Exception("Unacceptable document format.");
        }

        $this->format = $format;

        if ($format == 'pdf') {
            $this->setPdfFormat();
        }



        $objPHPExcel = new PHPExcel();
        $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array( 'memoryCacheSize ' => '2048MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->getDefaultStyle()->applyFromArray($styleArray, true);

        $this->objPHPExcel = $objPHPExcel;
    }

    private function setPdfFormat()
    {
        $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
        $rendererLibraryPath = dirname(__FILE__) . '/../../vendor/mpdf/mpdf';

        if (!PHPExcel_Settings::setPdfRenderer(
            $rendererName,
            $rendererLibraryPath
        )
        ) {
            die(
                'Please set the $rendererName and $rendererLibraryPath values' .
                PHP_EOL .
                ' as appropriate for your directory structure'
            );
        }
    }

    private function isAllowedFormat($type)
    {
        $formats = ['xls', 'pdf', 'html'];

        return in_array($type, $formats);
    }

    public function setRowLevel($rowLevelNum)
    {
        $this->rowLevel = $rowLevelNum;
    }

    public function getRowLevel()
    {
        return $this->rowLevel;
    }

    /**
     * Apply styles from array
     *
     * <code>
     *         array(
     *             'font'    => array(
     *                 'name'      => 'Arial',
     *                 'bold'      => true,
     *                 'italic'    => false,
     *                 'underline' => PHPExcel_Style_Font::UNDERLINE_DOUBLE,
     *                 'strike'    => false,
     *                 'color'     => array(
     *                     'rgb' => '808080'
     *                 )
     *             ),
     *             'borders' => array(
     *                 'bottom'     => array(
     *                     'style' => PHPExcel_Style_Border::BORDER_DASHDOT,
     *                     'color' => array(
     *                         'rgb' => '808080'
     *                     )
     *                 ),
     *                 'top'     => array(
     *                     'style' => PHPExcel_Style_Border::BORDER_DASHDOT,
     *                     'color' => array(
     *                         'rgb' => '808080'
     *                     )
     *                 )
     *             ),
     *             'quotePrefix'    => true
     *         )
     * </code>
     *
     * @param string $cellPeriod
     * @param array $styleArray Array containing style information
     */
    public function setStyleByArray($cellPeriod, $styleArray)
    {
        $activeSheet = $this->objPHPExcel->getActiveSheet();
        $activeSheet->getStyle($cellPeriod)->applyFromArray($styleArray, true);
    }

    public function setValueToCell($cell, $value, $mergeCellPeriod = false, $isBold = false)
    {
        $activeSheet = $this->objPHPExcel->setActiveSheetIndex();
        $activeSheet->setCellValue($cell, $value);
        if ($mergeCellPeriod) {
            $activeSheet->mergeCells($mergeCellPeriod);
        }
        if ($isBold) {
            $activeSheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function setColumnsWidth(array $widthArray)
    {
        $columnLetter = 'A';
        foreach ($widthArray as $width) {
            $this->setColumnWidth($columnLetter, $width);
            $columnLetter++;
        }
    }

    public function setColumnWidth($columnLetter, $width)
    {
        $this->objPHPExcel->getActiveSheet()->getColumnDimension($columnLetter)->setWidth($width);
    }

    public function setHeaderRow(array $headers)
    {
        $activeSheet = $this->objPHPExcel->getActiveSheet();
        $activeSheet->getRowDimension($this->rowLevel)->setRowHeight(40);
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $cell = $columnLetter . $this->rowLevel;
            $activeSheet->setCellValue($cell, $header);
            $activeSheet->getStyle($cell)->getFont()->setBold(true);
            $columnLetter++;
        }
        $this->rowLevel++;
    }

    public function insertData(array $data)
    {
        $startingCell = 'A' . $this->rowLevel;
        $this->objPHPExcel->getActiveSheet()->fromArray($data, NULL, $startingCell, true);
        $this->rowLevel += count($data);
    }

    public function returnDocument($filename)
    {
        $fullName = $filename . '.' . $this->format;
        $this
            ->objPHPExcel
            ->getProperties()
            ->setTitle("$filename")
            ->setSubject("$filename");
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $this->getWriterName());

        header('Content-Description: File Transfer');
        header("Content-Type: " . $this->getContentType());
        header("Content-Disposition: attachment; filename=\"$fullName\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        $objWriter->save('php://output');
    }

    private function getWriterName()
    {
        switch ($this->format) {
            case 'pdf':
                $writer = 'PDF';
                break;
            case 'html':
                $writer = 'HTML';
                break;
            case 'xls':
                // xls by default
            default:
                $writer = 'Excel5';
        }

        return $writer;
    }

    private function getContentType()
    {
        switch ($this->format) {
            case 'pdf':
                $contentType = 'application/pdf';
                break;
            case 'html':
                $contentType = 'text/html';
                break;
            case 'xls':
                // xls by default
            default:
                $contentType = 'application/vnd.ms-excel';
        }

        return $contentType;
    }
}
