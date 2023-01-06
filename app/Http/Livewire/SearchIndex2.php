<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Regency;
use Livewire\WithPagination;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class SearchIndex2 extends Component
{
    use WithPagination;
    protected $listeners = [
        'minRange',
        'maxRange',
        'dataLocation',
    ];

    public $searchjob,$locations,$kualif_lulus,$jenis_kerja,$minrange,$maxrange,$mylocation;
    public $isOpen = 0;

    public $myid = 0;
    public function postDetail($id){
        $this->myid = $id;
    }
    public function dataLocation($id){
        $this->mylocation = $id;
        $this->locations =  $id;
    }
    public function minRange($value){
        if(!is_null($value))
        $this->minrange = $value*1000000;
    }
    public function maxRange($value){
        if(!is_null($value))
        $this->maxrange = $value*1000000;
    }
    public function resetGaji(){
        $this->minrange = null;
        $this->maxrange = null;
        $this->searchJob();
    }
    public function searchJob(){
        // $this->postjob = $postjob;
        $emit = $this->emit('searchJobs', [$this->searchjob,$this->mylocation,$this->kualif_lulus,$this->jenis_kerja,$this->minrange,$this->maxrange]);
        // $emit = $this->emit('searchJobs', [$this->locations]);
        // dd($this->minrange." ".$this->maxrange);
    }
    public function render()
    {
        return view('livewire.search-index2');
    }
    public function resetFilter(){
        $this->locations = null;
        $this->kualif_lulus = null;
        $this->jenis_kerja = null;
        $this->minrange = null;
        $this->maxrange = null;
    }
    public function searchClick()
    {
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
}
