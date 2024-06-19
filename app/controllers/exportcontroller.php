<?php
require_once __DIR__ . '/../services/orderService.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require '../vendor/autoload.php';

class ExportController{
    private $orderService;

    public function __construct() {

        $this->orderService = new \App\Services\OrderService();
    }

    public function exportToCSV() {
        $columns = isset($_POST['columns']) ? $_POST['columns'] : [];
        $orders = $this->orderService->getAllOrders();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="orders.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, $columns);

        foreach ($orders as $order) {
            $row = [];
            foreach ($columns as $column) {
                $row[] = $order[$column];
            }
            fputcsv($output, $row);
        }

        fclose($output);
     
        exit;
        
    }

    public function exportToExcel() {
        $columns = isset($_POST['columns']) ? $_POST['columns'] : [];
        $orders = $this->orderService->getAllOrders();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        foreach ($columns as $colIndex => $column) {
            $sheet->setCellValueByColumnAndRow($colIndex + 1, 1, $column);
        }

        // Set the data rows
        foreach ($orders as $rowIndex => $order) {
            foreach ($columns as $colIndex => $column) {
                $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 2, $order[$column]);
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="orders.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
?>
