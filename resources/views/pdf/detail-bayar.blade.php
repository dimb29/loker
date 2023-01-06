<!DOCTYPE html>
<html>
<head>
	<title>Detail Pembayaran</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>

    h1 {
    background-color: ;
    color: #5086da;
    }

    h2 {
    background-color: ;
    letter-spacing: 5px;
    border-bottom-style: solid;
    border-color: #5086da;
    }

    #myDIV {
    width:150%;
    height:30px;
    border-color: #5086da;
    border-bottom:5px solid;
    }
    
    img {
    border-radius: 50%;
    display: block;
    margin-left: auto;
    margin-right: auto;
    }
    </style>

</head>
<body>

<table class="" style="width:40%;height:99%;float:left;background-image:url({{url('storage/photos/cv22.jpg')}});background-position:right top;background-size:contain;">
<tbody>
<tr>
<div class="ml-11 mt-4">
<img class="object-cover h-48 w-48" src="{{url('storage/photos/pp.jpg')}}">
</div>
</tr>


<tr>
    <h3 class="uppercase text-lg font-bold ml-6 mr-2 mt-32">Ringkasan karier</h3>
    <h3 class="ml-6 text-sm">
        Saya adalah teknisi robot dengan pengetahuan mendalam dalam ilmu Komputer dan teknik listrik. Saya
        telah bekerja dalam lingkungan akademik dan korporat
    </h3>


    <h3 class="uppercase text-lg font-bold ml-6 mt-28">keahlian profesional</h3>
    <h3 class="ml-6 text-sm">
        - Instalasi dan Perbaikan Bug
        <br>
        - Desain Teknologi
        <br>
        - Analisis dan Evaluasi Sistem
        <br>
        - Pembelajaran Mesin
        <br>
        - Kecerdasan Buatan
        <br>
        - Pemrograman Komputer
    </h3>

    <h3 class="uppercase text-lg font-bold ml-3 mt-48">cara menghubungi saya</h3>
    <h3 class="ml-3 text-sm mt-4">
        Email : halo123@gmail.com
        <br>
        Telepon : (023) 4567 8901
        <br>
        Situs web : www.sayarajin.com
        <br>
        Alamat : Jalan Pembangunan No. 234
        <br>
        Bekasi, Jabar, Indonesia 12345
    </h3>
</tr>
</tbody>
</table>

<table class="" cellpadding="0" cellspacing="0" style="width:60%;float:left">
<tbody>
 <tr>
  <td>
    <h1 class="uppercase font-bold text-5xl ml-6">dara</h1>
    <h1 class="uppercase font-bold text-5xl ml-6">arafah</h1>
    <h2 class="uppercase font-extralight mt-2 ml-6">TEKNISI ROBOTIK</h2>
  </td>
  <!-- <td> 12</td> -->
</tr>
<tr>
  <td> 
    <div id="myDIV" class=""></div>
  </td>
</tr>
<tr>
    <h3 class="uppercase font-bold text-lg ml-6 mt-8 mb-2">Pengalaman Kerja</h3>
</tr>
<tr>
    <h3 class="capitalize text-base font-bold ml-6 ">Kepala Teknisi Robotik</h3>
    <h3 class="capitalize ml-6 my-1 text-sm">perusahaan gegana | Des 2015 - sekarang</h3>
    <h3 class="ml-6 text-xs">
        - Merancang dan mengintegrasi robot yang berpadu mulus dengan proses klien
        <br>
        - Bekerja berdampingan dengan teknisi, developer, dan manajer
    </h3>


    <h3 class="capitalize text-base font-bold ml-6 mt-6">teknisi robotik</h3>
    <h3 class="capitalize ml-6 my-1 text-sm">odk Global sistem | jan 2014 - nov 2015</h3>
    <h3 class="ml-6 text-xs">
        - Mengembangkan solusi efisien untuk program robotik yang digunakan secara realtime oleh klien
        <br>
        - Mengelola skema listrik dengan isntalasi awal
    </h3>
<!-- 
    <h3 class="capitalize text-base font-bold ml-6 mt-6">teknisi robotik</h3>
    <h3 class="capitalize ml-6 my-1 text-sm">odk Global sistem | jan 2014 - nov 2015</h3>
    <h3 class="ml-6 text-xs">
        - Mengembangkan solusi efisien untuk program robotik yang digunakan secara realtime oleh klien
        <br>
        - Mengelola skema listrik dengan isntalasi awal
    </h3> -->
</tr>

<tr>
    <h3 class="uppercase font-bold text-lg ml-6 mt-10 mb-2">Riwayat Pendidikan</h3>
</tr>
<tr>
    <h3 class="capitalize text-base font-bold ml-6 ">perguruan tinggi darma</h3>
    <h3 class="capitalize ml-6 my-1 text-sm">master sains | jan 2010 - des 2013</h3>
    <h3 class="capitalize ml-6 mb-1 text-sm">magister ilmu robotik dan kelistrikan mesin</h3>
    <h3 class="ml-6 text-xs">
        - Menciptakan robot yang dapat membantu operasi dalam prosedur invasif minimal dan mengadakan presentasi publik
    </h3>


    <h3 class="capitalize text-base font-bold ml-6 mt-6">universitas goetan</h3>
    <h3 class="capitalize ml-6 my-1 text-sm">sarjana sains | Jan 2006 - des 2009</h3>
    <h3 class="capitalize ml-6 mb-1 text-sm">sarjana teknik listrik</h3>
    <h3 class="ml-6 text-xs">
        - Mengerjakan tesis sarjana tentang simulasi fungsi otak dengan sistem elektronik
        - Anggota, Asosiasi Sains Komputer UG
    </h3>
</tr>

<tr>
    <h3 class="uppercase font-bold text-base ml-6 mt-10 mb-6" >Referensi kerja</h3>
</tr>
<tr>
    <h3 class="text-base ml-6 " >
        Konsultan Robotik Amir Syah, universitas Goetan
        <br>
        Email : halo@gmail.com
        <br>
        Teknisi Donna Susia, ODK Global sistem
        <br>
        Email : halohalo@gmail.com
    </h3>
</tr>
</tbody>
</table>

</body>
</html>