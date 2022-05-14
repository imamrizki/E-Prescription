<style type="text/css">

th {
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    font-family: Times New Roman;
    height: 20px;
    padding: 2px;
}

td {
    font-size: 10px;
}

</style>

<h1 style="font-family: Times New Roman; text-align: center; ">Resep Digital</h1>

<table border="0">
    <tr>
        <td style="width: 20%">Kode Resep</td>
        <td style="width: 80%">: {{ $kodeResep }}</td>
    </tr>
    <tr>
        <td colspan="2" style="height: 50px;"></td>
    </tr>
    {!! $resepNonRacik !!}
    {!! $resepRacik !!}
    
</table>
   