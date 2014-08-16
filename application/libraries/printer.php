<?php

/**
 * This class helps to print a bill using a printer.
 * if you use epson printer change handler like printer_open('EPSON LQ-300+ /II ESC/P 2');
 *
 * @author Eranda Bandaranaike
 */
class printer {

    private $row_Start = 0;
    private $row_Space = 60;
    private $line_space = 20;
    private $drug_Start = 20;
    private $qnty_start = 370;
    private $price_Start = 470;
    private $handle;

    public function __construct($handle = 'Zan Image Printer(color)') {
        $this->handle = printer_open($handle);
    }

    public function setPrinter($billNumber) {

        printer_set_option($this->handle, PRINTER_COPIES, 1);
        printer_set_option($this->handle, PRINTER_MODE, "text");
        printer_set_option($this->handle, PRINTER_TITLE, "Hearnas");
        printer_set_option($this->handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_LANDSCAPE);
        printer_set_option($this->handle, PRINTER_RESOLUTION_Y, 200);
        printer_set_option($this->handle, PRINTER_RESOLUTION_X, 500);
        printer_set_option($this->handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_CUSTOM);
        printer_set_option($this->handle, PRINTER_PAPER_WIDTH, 10);
        printer_set_option($this->handle, PRINTER_PAPER_LENGTH, 50);
        printer_set_option($this->handle, PRINTER_SCALE, 500);
        printer_set_option($this->handle, PRINTER_TEXT_COLOR, "000000");
        printer_set_option($this->handle, PRINTER_BACKGROUND_COLOR, "FFFFFF");

        printer_start_doc($this->handle, $billNumber);
        printer_start_page($this->handle);

        $font1 = printer_create_font("Times New Roman", 50, 17, PRINTER_FW_MEDIUM, false, false, false, 0);
        printer_select_font($this->handle, $font1);
        printer_draw_text($this->handle, "WIJAYA PHARMACY", 110, $this->row_Start);
        printer_delete_font($font1);

        $font2 = printer_create_font("Times New Roman", 42, 16, PRINTER_FW_MEDIUM, false, false, false, 0);
        printer_select_font($this->handle, $font2);
        printer_draw_text($this->handle, "1/3A,Hospital Rd,Hawa Eliya", 90, $this->row_Start+=(2 * $this->row_Space));
        printer_draw_text($this->handle, "Nuwara Eliya", 200, $this->row_Start+=$this->row_Space);
        printer_draw_text($this->handle, "TEL:0523531637", 175, $this->row_Start+=$this->row_Space);

        printer_draw_text($this->handle, date("Y-m-d H:i:s"), 10, $this->row_Start + $this->row_Space);
        printer_draw_text($this->handle, "No." . $billNumber, 480, $this->row_Start+=$this->row_Space);
        printer_delete_font($font2);

        $pen = printer_create_pen(PRINTER_PEN_SOLID, 1, 555555);
        printer_select_pen($this->handle, $pen);
        printer_draw_line($this->handle, 5, $this->row_Start + $this->row_Space, 650, $this->row_Start+=$this->row_Space);
        $this->row_Start+=$this->row_Space;
    }

    public function setBillBody($drug = array(), $amount = array(), $price = array()) {
        $font2 = printer_create_font("Times New Roman", 42, 16, PRINTER_FW_MEDIUM, false, false, false, 0);
        printer_select_font($this->handle, $font2);
        for ($index = 1; $index < count($drug); $index++) {
            printer_draw_text($this->handle, $drug[$index], $this->drug_Start, $this->row_Start);
            printer_draw_text($this->handle, $amount[$index], $this->qnty_start, $this->row_Start);
            printer_draw_text($this->handle, @number_format(($price[$index]), 2), $this->price_Start, $this->row_Start);
            $this->row_Start = $this->row_Start + $this->row_Space;
        }
    }

    public function setBillFooter($total) {
        $pen = printer_create_pen(PRINTER_PEN_DASH, 1, 555555);
        printer_select_pen($this->handle, $pen);
        printer_draw_line($this->handle, 5, $this->row_Start + $this->row_Space, 650, $this->row_Start+=$this->row_Space);

        $font3 = printer_create_font("Times New Roman", 42, 16, PRINTER_FW_BOLD, false, false, false, 0);
        printer_select_font($this->handle, $font3);
        printer_draw_text($this->handle, "Total", 270, $this->row_Start + $this->row_Space);
        printer_draw_text($this->handle, number_format($total, 2), $this->price_Start - 5, $this->row_Start += $this->row_Space);

        $this->row_Start += $this->row_Space;

        $font = printer_create_font("Times New Roman", 42, 16, PRINTER_FW_MEDIUM, false, false, false, 0);
        printer_select_font($this->handle, $font);
        printer_draw_text($this->handle, "Thank You. Come Again !", 105, $this->row_Start += $this->row_Space);
        $font = printer_create_font("Times New Roman", 35, 13, PRINTER_FW_BOLD, TRUE, false, false, 0);
        printer_select_font($this->handle, $font);
        printer_draw_text($this->handle, "YOUR HEALTH IS OUR CONCERN", 80, $this->row_Start += $this->row_Space);
        printer_delete_font($font);

        $this->row_Start += $this->row_Space;

        $font = printer_create_font("Times New Roman", 30, 12, PRINTER_FW_NORMAL, FALSE, false, false, 0);
        printer_select_font($this->handle, $font);
        printer_draw_text($this->handle, "System by Eranda - 0717067202", 110, $this->row_Start += $this->row_Space);
        $this->row_Start += 2 * $this->row_Space;
        printer_draw_text($this->handle, ".", 110, $this->row_Start += $this->row_Space);

        printer_end_page($this->handle);
        printer_end_doc($this->handle);
        printer_close($this->handle);
    }

}