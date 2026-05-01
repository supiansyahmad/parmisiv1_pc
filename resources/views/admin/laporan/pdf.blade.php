<!DOCTYPE html>
<html>
<head>
    <title>Laporan Izin Keluar</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; }
        h2 { text-align: center; margin-bottom: 5px; }
        h4 { text-align: center; margin-top: 0px; font-weight: normal; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <h2>REKAPITULASI IZIN KELUAR KANTOR</h2>
    <h4>Periode: {{ $tglAwal }} s.d. {{ $tglAkhir }}</h4>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 25%">Nama Pegawai / NIP</th>
                <th style="width: 15%">Rencana Jam</th>
                <th>Keperluan</th>
                <th style="width: 10%">Status Kembali</th> </tr>
        </thead>
        <tbody>
            @forelse($izins as $index => $izin)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }}
                </td>
                <td>
                    <strong>{{ $izin->user->name }}</strong><br>
                    <small>{{ $izin->user->nip }}</small>
                </td>
                <td class="text-center">
                    {{ substr($izin->jam_keluar, 0, 5) }} - {{ substr($izin->jam_kembali, 0, 5) }}
                </td>
                <td>{{ $izin->keperluan }}</td>
                
                <td class="text-center">
                    @if($izin->status_kembali == 1)
                        Sudah
                    @else
                        <span style="color: red; font-style: italic;">Belum Kembali</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data izin pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <table style="width: 100%; margin-top: 30px; border: none;">
        <tr>
            <td style="width: 70%; border: none;"></td>
            
            <td style="width: 30%; text-align: center; border: none;">
                <p>Barabai, {{ date('d-m-Y') }}</p>
                <p style="margin-top: -10px;">Kepala Sub Bagian Kepegawaian, Organisasi dan Tata Laksana,</p>
                
                <br><br><br>
                
                <p style="font-weight: bold; text-decoration: underline; margin-bottom: 0;">
                    {{ $admin->name }}
                </p>
                
                <p style="margin-top: 2px;">NIP. {{ $admin->nip }}</p>
            </td>
        </tr>
    </table>

</body>
</html>