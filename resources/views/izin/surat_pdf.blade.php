<!DOCTYPE html>
<html>
<head>
    <title>Surat Izin Keluar Kantor</title>
    <style>
        body { 
            font-family: "Times New Roman", serif; 
            font-size: 12pt; 
            margin: 0cm 1cm;
        }
        
        /* KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 4px double black; padding-bottom: 10px; margin-bottom: 25px; }
        .logo-cell { width: 15%; text-align: center; vertical-align: top; }
        .text-cell { width: 85%; text-align: center; }
        .line-1, .line-2, .line-3 { font-size: 14pt; font-weight: bold; text-transform: uppercase; }
        .line-4 { font-size: 14pt; font-weight: bold; text-transform: uppercase; margin-top: 2px; }
        .alamat { font-size: 10pt; font-style: italic; margin-top: 2px; }

        /* JUDUL */
        .judul { 
            font-weight: bold; font-size: 14pt; text-align: center; 
            text-transform: uppercase; margin-bottom: 20px; text-decoration: underline; 
        }

        /* TABEL DATA UTAMA */
        table.data { width: 100%; margin-left: 20px; margin-bottom: 10px; }
        table.data td { padding: 5px; vertical-align: top; }
        .label { width: 140px; }

        /* --- PERBAIKAN: TABEL TANDA TANGAN --- */
        /* Menggunakan tabel agar posisi pasti muncul dan rapi */
        table.ttd-table {
            width: 100%;
            margin-top: 50px;
            border: none;
        }
        table.ttd-table td {
            border: none;
            vertical-align: top;
        }
    </style>
</head>
<body>

    <table class="kop-surat">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('logosurat.png') }}" width="80" height="auto">
            </td>
            <td class="text-cell">
                <div class="line-1">MAHKAMAH AGUNG REPUBLIK INDONESIA</div>
                <div class="line-2">DIREKTORAT JENDERAL BADAN PERADILAN AGAMA</div>
                <div class="line-3">PENGADILAN TINGGI AGAMA BANJARMASIN</div>
                <div class="line-4">PENGADILAN AGAMA BARABAI KELAS IB</div>
                <div class="alamat">Jl. H. Abdul Muis Redhani No. 62 RT. 08, Kec. Barabai Kab. Hulu Sungai Tengah, 71312</div>
                <div class="alamat">Telp. (0517) 41041 | Website: www.pa-barabai.go.id | Email: pa.barabai@gmail.com</div>

            </td>
        </tr>
    </table>

    <div class="judul">SURAT IZIN KELUAR KANTOR</div>

    <p>Yang bertanda tangan di bawah ini memberikan izin kepada:</p>

    <table class="data">
        <tr>
            <td class="label">Nama</td>
            <td>: <strong>{{ $izin->user->name }}</strong></td>
        </tr>
        <tr>
            <td class="label">NIP</td>
            <td>: {{ $izin->user->nip }}</td>
        </tr>
        <tr>
            <td class="label">Keperluan</td>
            <td>: {{ $izin->keperluan }}</td>
        </tr>
        <tr>
            <td class="label">Waktu Izin</td>
            <td>: 
                @php
                    // Paksa set locale ke Indonesia untuk Carbon di halaman ini
                    \Carbon\Carbon::setLocale('id');
                @endphp
                {{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }} <br> 
                &nbsp;&nbsp;Pukul {{ substr($izin->jam_keluar, 0, 5) }} s.d. {{ substr($izin->jam_kembali, 0, 5) }} WITA
            </td>
        </tr>
    </table>

    <p>Demikian surat izin ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

    <table class="ttd-table">
        <tr>
            <td width="40%"></td>
            
            <td width="60%" align="center">
                <p>Barabai, {{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }}</p>
                
                <p style="margin-top: -10px;">
                    {{ $izin->user->atasan_id == null ? 'Tertanda,' : 'Atasan Langsung,' }}
                </p>
                
                <div style="margin: 10px 0;">
                    <img src="data:image/svg+xml;base64, {{ $qrcode }}" width="90">
                </div>
                
                @if($izin->user->atasan_id != null)
                    @php
                        // Ambil nama atasan
                        $namaAtasan = $izin->user->atasan->name;
                        // Cek panjang karakter. Jika lebih dari 25 huruf, font dikecilkan jadi 10pt, jika tidak tetap 12pt.
                        $fontSize = strlen($namaAtasan) > 25 ? '10pt' : '12pt';
                    @endphp
                    <p style="font-weight: bold; text-decoration: underline; margin-bottom: 0;">
                        {{ $izin->user->atasan->name }}
                    </p>
                    <p style="margin-top: 2px;">NIP. {{ $izin->user->atasan->nip }}</p>
                @endif
            </td>
        </tr>
    </table>

</body>
</html>