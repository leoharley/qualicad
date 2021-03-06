<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CSV Reader for CodeIgniter 3.x
 *
 * Library to read the CSV file. It helps to import a CSV file
 * and convert CSV data into an associative array.
 *
 * This library treats the first row of a CSV file
 * as a column header row.
 *
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     3.0
 */
class CSVReader {
    
    // Columns names after parsing
    private $fields;
    // Separator used to explode each line
    private $separator = '@';
    // Enclosure used to decorate each field
    private $enclosure = '@';
    // Maximum row size to be used for decoding
    private $max_row_size = 4096;
    
    /**
     * Parse a CSV file and returns as an array.
     *
     * @access    public
     * @param    filepath    string    Location of the CSV file
     *
     * @return mixed|boolean
     */
    function parse_csv($filepath,$tpImportacao = null){

        if ($tpImportacao == 'simpro') {
            $separador = ';';
        } else {
            $separador = '|';
        }

        // If file doesn't exist, return false
        if(!file_exists($filepath)){
            return FALSE;            
        }
        
        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($filepath, 'r');
        
        // Get Fields and values
        if ($tpImportacao == 'simpro') {
            $linha = 'CD_USUARIO;CD_FRACAO;DESCRICAO;VIGENCIA;IDENTIF;PC_EM_FAB;PC_EM_VEN;PC_EM_USU;PC_FR_FAB;PC_FR_VEN;PC_FR_USU;TP_EMBAL;TP_FRACAO;QTDE_EMBAL;QTDE_FRAC;PERC_LUCR;TIP_ALT;FABRICA;CD_SIMPRO;CD_MERCADO;PERC_DESC;VLR_IPI;CD_REG_ANV;DT_REG_ANV;CD_BARRA;LISTA;HOSPITALAR;FRACIONAR;CD_TUSS;CD_CLASSIF;CD_REF_PRO;GENERICO;DIVERSOS';
            $keys_values = explode($separador, $linha);
            $keys = $this->escape_string($keys_values);
        }
        else if ($tpImportacao == null) {
            $this->fields = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure);        
            $keys_values = explode($separador, $this->fields[0]);
            $keys = $this->escape_string($keys_values);
        }
        
        // Store CSV data in an array
        $csvData = array();
        $i = 1;
        while(($row = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure)) !== FALSE){
            // Skip empty lines
            if($row != NULL){
                $values = explode($separador, $row[0]);
                if(count($keys) == count($values)){
                    $arr        = array();
                    $new_values = array();
                    $new_values = $this->escape_string($values);
                    for($j = 0; $j < count($keys); $j++){
                        if($keys[$j] != ""){
                            $arr[$keys[$j]] = $new_values[$j];
                        }
                    }
                    $csvData[$i] = $arr;
                    $i++;
                }
            }
        }
        // Close opened CSV file
        fclose($csvFile);
        
        return $csvData;
    }

    function escape_string($data){
        $result = array();
        foreach($data as $row){
            $result[] = str_replace('"', '', $row);
        }
        return $result;
    }   
}