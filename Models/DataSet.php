<?php

namespace Models;

use App\Model;

/**
 * Main data-model
 * Can be created from one array immediately.
 * Adding/deleting one by one are possible.
 */
class DataSet extends Model
{
    private $raw_data = [];
    private $fieldset = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->raw_data = $data;
            $this->indexSrcDataset();
        }
    }

    /**
     * Indexing one dataset entry and update the fields set (all uniques properties)
     *
     * @param $entry
     * @return void
     */
    private function indexSrcEntry($entry)
    {
        foreach ($entry as $key => $value) {
            if (!array_key_exists($key, $this->fieldset)) {
                $this->fieldset[$key] = mb_strlen($value);
            } else {
                $new_length = mb_strlen($value);
                if ($new_length > $this->fieldset[$key]) $this->fieldset[$key] = $new_length;
            }
        }
    }

    /**
     * Indexing current dataset and create the fields set (all uniques properties)
     *
     * @return void
     */
    private function indexSrcDataset()
    {
        $this->fieldset = [];
        foreach ($this->raw_data as $one_entry) {
            $this->indexSrcEntry($one_entry);
        }
    }

    public function getFieldset(): array
    {
        return $this->fieldset;
    }

    public function getEntryByIndex($index): array
    {
        // @todo speed test!!!
        $data = [];
        foreach ($this->fieldset as $key => $value) {
            $data[$key] = $this->raw_data[$index][$key] ?? null;
        }
        return $data;
    }

    public function setSrcDataSet($data)
    {
        $this->raw_data = $data;
        $this->indexSrcDataset();
    }

    public function getSrcDataSet(): array
    {
        return $this->raw_data;
    }

    public function addSrcEntry($entry)
    {
        $this->raw_data[] = $entry;
        $this->indexSrcEntry($entry);
    }

    public function delSrcEntry($entry_num)
    {
        unset($this->raw_data[$entry_num]);
        $this->raw_data = array_values($this->raw_data);
        $this->indexSrcDataset();
    }

}
