<?php 

namespace App\Controllers;

use App\Models\M_penjualan;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class menu_laporan extends BaseController
{
public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_penjualan();

            $data['title'] = 'Laporan Penjualan';
            $data['desc'] = 'Anda dapat mengprint Data Penjualan di Menu ini.';      
            $data['subtitle'] = 'Print Laporan Penjualan';             

            echo view('partial/header_datatable', $data);
            echo view('partial/side_menu');
            echo view('partial/top_menu');
            echo view('laporan_penjualan/menu_laporan', $data);
            echo view('partial/footer_datatable');
        }else {
            return redirect()->to('/');
        }
    }

    public function export_windows()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_penjualan();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            // Get data absensi kantor berdasarkan filter
            $data['penjualan'] = $model->getAllPenjualanPeriode($awal, $akhir);
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            
            $data['title'] = 'Laporan Penjualan';
           
            echo view('laporan_penjualan/print_windows_view', $data);
         
        } else {
            return redirect()->to('/');
        }
    }

    public function export_pdf()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_penjualan();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            // Get data absensi kantor berdasarkan filter
            $data['penjualan'] = $model->getAllPenjualanPeriode($awal, $akhir);
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            
            // Load the dompdf library
            $dompdf = new Dompdf();

            // Set the HTML content for the PDF
            $data['title'] = 'Laporan Penjualan';
            $dompdf->loadHtml(view('laporan_penjualan/print_pdf_view',$data));
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            
            // Generate file name with start and end date
            $file_name = 'laporan_penjualan_' . str_replace('-', '', $awal) . '_' . str_replace('-', '', $akhir) . '.pdf';

            // Output the generated PDF (inline or attachment)
            $dompdf->stream($file_name, ['Attachment' => 0]);

        } else {
            return redirect()->to('/');
        }
    }

    public function export_excel()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_penjualan();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            $penjualan = $model->getAllPenjualanPeriode($awal, $akhir);

            $spreadsheet = new Spreadsheet();

            // Get the active worksheet and set the default row height for header row
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->getDefaultRowDimension()->setRowHeight(20);

            $sheet->mergeCells('A1:F1');
            $sheet->setCellValue('A1', 'Data Laporan Penjualan');

            $periode = date('d F Y', strtotime($awal)) . ' - ' . date('d F Y', strtotime($akhir));
            $sheet->mergeCells('A2:F2');
            $sheet->setCellValue('A2', 'Periode: ' . $periode);

            // $sheet->setCellValue('G3', 'Jumlah Penjualan : ' . count($penjualan));

            // Set the header row values
            $sheet->setCellValueByColumnAndRow(1, 4, 'No.');
            $sheet->setCellValueByColumnAndRow(2, 4, 'Nama Produk');
            $sheet->setCellValueByColumnAndRow(3, 4, 'Jumlah Produk');
            $sheet->setCellValueByColumnAndRow(4, 4, 'Subtotal');
            $sheet->setCellValueByColumnAndRow(5, 4, 'Kasir');
            $sheet->setCellValueByColumnAndRow(6, 4, 'Tanggal Penjualan');

            // Fill the data into the worksheet
            $row = 5;
            $no = 1;
            foreach ($penjualan as $riz) {
                $sheet->setCellValueByColumnAndRow(1, $row, $no++);
                $sheet->setCellValueByColumnAndRow(2, $row, $riz->NamaProduk);
                $sheet->setCellValueByColumnAndRow(3, $row, $riz->JumlahProduk . ' buah');

                // Mengganti koma dengan titik dan mengonversi ke float
                $subtotal = str_replace(',', '', $riz->Subtotal);
                $subtotal = floatval($subtotal);

                // Mengisi sel dengan nilai yang diformat sebagai accounting
                $sheet->setCellValueByColumnAndRow(4, $row, $subtotal);
                $sheet->setCellValueByColumnAndRow(5, $row, $riz->username);
                $sheet->setCellValueByColumnAndRow(6, $row, date('d F Y, H:i', strtotime($riz->created_at_detailpenjualan)));

                $row++;
            }

        // Apply the Excel styling
            $sheet->getStyle('A1')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);

            $sheet->getStyle('A2')->getFont()->setBold(true);
            $sheet->getStyle('A2')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            $sheet->getStyle('A4:F4')->getFont()->setBold(true);
            $sheet->getStyle('A4:F4')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];

            $alignmentArray = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];


        $lastRow = count($penjualan) + 4; // Add 4 for the header rows
        $sheet->getStyle('A4:F' . $lastRow)->applyFromArray($styleArray);
        $sheet->getStyle('A5:A' . $lastRow)->applyFromArray($alignmentArray);
        $sheet->getStyle('D5:D' . $lastRow)->getNumberFormat()->setFormatCode('_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->setShowGridlines(false);

        // Generate file name with start and end date
        $file_name = 'laporan_penjualan_' . str_replace('-', '', $awal) . '-' . str_replace('-', '', $akhir) . '.xlsx';

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = $file_name;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    } else {
        return redirect()->to('/');
    }
}


// --------------------------------- PRINT LAPORAN PER HARI -----------------------------------


public function export_windows_per_hari()
{
    if (session()->get('level') == 1 || session()->get('level') == 2) {
        $model = new M_penjualan();

        $tanggal = $this->request->getPost('tanggal');

            // Get data penjualan berdasarkan tanggal
        $data['penjualan'] = $model->getAllPenjualanPerHari($tanggal);
        $data['tanggal'] = $tanggal;

        $data['title'] = 'Laporan Penjualan';
        echo view('partial/header_datatable', $data);
        echo view('laporan_penjualan/print_windows_view', $data);
       
    } else {
        return redirect()->to('/');
    }
}

public function export_pdf_per_hari()
{
    if (session()->get('level') == 1 || session()->get('level') == 2) {
        $model = new M_penjualan();

        $tanggal = $this->request->getPost('tanggal');

            // Get data penjualan berdasarkan tanggal
        $data['penjualan'] = $model->getAllPenjualanPerHari($tanggal);
        $data['tanggal'] = $tanggal;

            // Load the dompdf library
        $dompdf = new Dompdf();

            // Set the HTML content for the PDF
        $data['title'] = 'Laporan Penjualan';
        $dompdf->loadHtml(view('laporan_penjualan/print_pdf_view',$data));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();

            // Generate file name with start and end date
        $file_name = 'laporan_penjualan_' . str_replace('-', '', $awal) . '_' . str_replace('-', '', $akhir) . '.pdf';

            // Output the generated PDF (inline or attachment)
        $dompdf->stream($file_name, ['Attachment' => 0]);
    } else {
        return redirect()->to('/');
    }
}

public function export_excel_per_hari()
{
    if (session()->get('level') == 1 || session()->get('level') == 2) {
        $model = new M_penjualan();

        $tanggal = $this->request->getPost('tanggal');

        $penjualan = $model->getAllPenjualanPerHari($tanggal);

        $spreadsheet = new Spreadsheet();

            // Get the active worksheet and set the default row height for header_datatable row
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Data Laporan Penjualan');

        $periode = date('d F Y', strtotime($tanggal));
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Periode: ' . $periode);

            // $sheet->setCellValue('G3', 'Jumlah Penjualan : ' . count($penjualan));

            // Set the header_datatable row values
        $sheet->setCellValueByColumnAndRow(1, 4, 'No.');
        $sheet->setCellValueByColumnAndRow(2, 4, 'Nama Produk');
        $sheet->setCellValueByColumnAndRow(3, 4, 'Jumlah Produk');
        $sheet->setCellValueByColumnAndRow(4, 4, 'Subtotal');
        $sheet->setCellValueByColumnAndRow(5, 4, 'Kasir');
        $sheet->setCellValueByColumnAndRow(6, 4, 'Tanggal Penjualan');

            // Fill the data into the worksheet
        $row = 5;
        $no = 1;
        foreach ($penjualan as $riz) {
            $sheet->setCellValueByColumnAndRow(1, $row, $no++);
            $sheet->setCellValueByColumnAndRow(2, $row, $riz->NamaProduk);
            $sheet->setCellValueByColumnAndRow(3, $row, $riz->JumlahProduk . ' buah');

                // Mengganti koma dengan titik dan mengonversi ke float
            $subtotal = str_replace(',', '', $riz->Subtotal);
            $subtotal = floatval($subtotal);

                // Mengisi sel dengan nilai yang diformat sebagai accounting
            $sheet->setCellValueByColumnAndRow(4, $row, $subtotal);
            $sheet->setCellValueByColumnAndRow(5, $row, $riz->username);
            $sheet->setCellValueByColumnAndRow(6, $row, date('d F Y, H:i', strtotime($riz->created_at_detailpenjualan)));

            $row++;
        }

        // Apply the Excel styling
        $sheet->getStyle('A1')->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);

        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A2')->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->getStyle('A4:F4')->getFont()->setBold(true);
        $sheet->getStyle('A4:F4')->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        $borderArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $alignmentArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];


        $lastRow = count($penjualan) + 4; // Add 4 for the header_datatable rows
        $sheet->getStyle('A4:F' . $lastRow)->applyFromArray($borderArray);
        $sheet->getStyle('A5:A' . $lastRow)->applyFromArray($alignmentArray);
        $sheet->getStyle('D5:D' . $lastRow)->getNumberFormat()->setFormatCode('_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->setShowGridlines(false);

        // Generate file name with start and end date
        $file_name = 'laporan_penjualan_' . str_replace('-', '', $tanggal) . '.xlsx';

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = $file_name;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    } else {
        return redirect()->to('/');
    }
}
}
