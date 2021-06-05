<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: baseline;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #customers {
              font-family: Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }

            #customers td, #customers th {
              border: 1px solid #ddd;
              padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: blue;
              color: white;
            }
            input[type=text] {
              width: 80%;
              padding: 12px 20px;
              margin: 8px 0;
              box-sizing: border-box;
            }
            .button {
             background-color: blue; /* Green */
              border: none;
              color: white;
              padding: 12px 32px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
              
                <div class="content">
                <h1>Tambah / Edit</h1>
                <input type="text" hidden name="id" class="id">
                <input type="text" placeholder="NAMA" name="nama" class="nama" style="
    margin: 0 120px 0 0px;
">
                <input type="text" placeholder="MENGAJAR" name="mengajar" class="mengajar">
                {{-- <div style="padding: 5px"></div> --}}
                <button class="button" onclick="simpan()">simpan</button>



                <div>
                <div style="padding: 10px"></div>
                <h1>Cari</h1>
                <input type="text" placeholder="CARI NAMA GURU" name="filter" class="filter">
                <br>
                <button class="button" onclick="cari()">cari</button>
                </div>
                <table id="customers" style="width: 800px;">
                    <tr>
                        <th>id</th>
                        <th>nama</th>
                        <th>Mengajar</th>
                        <th>aksi</th>
                    </tr>
                    <tbody class="drop_here">
                    @foreach($data as $el)

                        <tr>
                            <td>{{$el->id}}</td>
                            <td>{{$el->nama}}</td>
                            <td>{{$el->mengajar}}</td>
                            <td>
                                <button class="button" style="background-color: orange;" onclick="edit('{{$el->id}}','{{$el->nama}}','{{$el->mengajar}}')">edit</button>
                                <button class="button" style="background-color: pink;color:black" onclick="hapus({{$el->id}})">hapus</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div> 
        </div>
    </body>
</html>


<script type="text/javascript">
    
    function cari(argument) {
        var id = $('.filter').val();
        $.ajax({
                dataType: 'json',
                url: "{{ route('cari') }}",
                data: {
                    id
                },
                type: 'get',
                success: function(data) {
                    $('.drop_here').empty();
                    $.each(data.hasil, function(index) {
                            console.log(data.hasil[index].nama);
                            $('.drop_here').append(
                                '<tr>'+
                                    '<td>'+data.hasil[index].id+'</td>'+
                                    '<td>'+data.hasil[index].nama+'</td>'+
                                    '<td>'+data.hasil[index].mengajar+'</td>'+
                                    '<td><button class="button" style="background-color: orange;" onclick="edit('+data.hasil[index].id+','+data.hasil[index].nama+','+data.hasil[index].mengajar+')">edit</button><button class="button" style="background-color: pink;color:black" onclick="hapus('+data.hasil[index].id+')">hapus</button></td>'+
                                '</tr>'
                            );
                        });
                }
        });
    }

    function simpan() {

        var id = $('.id').val();
        var nama = $('.nama').val();
        var mengajar = $('.mengajar').val();
        $.ajax({
                dataType: 'json',
                url: "{{ route('simpan') }}",
                data: {
                    id,nama,mengajar
                },
                type: 'get',
                success: function(data) {
                    if (data.hasil == '1') {
                        alert('sukses');
                        location.reload();
                    }else{
                        alert('gagal');
                    }
                }
        });

    }

    function hapus(argument) {

        $.ajax({
                dataType: 'json',
                url: "{{ route('hapus') }}",
                data: {
                    id:argument
                },
                type: 'get',
                success: function(data) {
                    if (data.hasil == '1') {
                        alert('sukses');
                        location.reload();
                    }else{
                        alert('gagal');
                    }
                }
        });

    }

    function edit(a,b,c) {
        $('.id').val(a);
        $('.nama').val(b);
        $('.mengajar').val(c);

    }


</script>
