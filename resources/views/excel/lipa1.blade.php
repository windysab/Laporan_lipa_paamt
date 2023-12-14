<table class="table-striped table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Perkara</th>
            <th>Kode Perkara</th>
            <th>Majelis Hakim Nama</th>
            <th>Panitera Pengganti Text</th>
            <th>Tanggal Pendaftaran</th>
            <th>Penetapan Majelis Hakim</th>
            <th>Penetapan Hari Sidang</th>
            <th>Sidang Pertama</th>
            <th>Tanggal Putusan</th>
            <th>Status Putusan</th>
            <th>Status Pekerjaan</th>
            <th>Keterangan</th>
            <th>alamat gaib</th>
            <th>prodeo</th>
            <th>perkara ecourt</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nomor_perkara }}</td>
            <td>{{ $item->jenis_perkara_nama }}</td>
            <td>{!! nl2br(e(str_replace('</br>', ', ', $item->majelis_hakim_nama))) !!}
            </td>
            <td>{{ $item->panitera_pengganti_text }}</td>
            <td>{{ $item->tanggal_pendaftaran }}</td>
            <td>{{ $item->penetapan_majelis_hakim }}</td>
            <td>{{ $item->penetapan_hari_sidang }}</td>
            <td>{{ $item->sidang_pertama }}</td>
            <td>{{ $item->tanggal_putusan }}</td>
             <td>
                <?php
                // Misalkan $item adalah objek atau array yang berisi data, dan $tanggal_putusan adalah tanggal putusan yang diinginkan.
                $tanggal_hasil = $item->tanggal_putusan;  // Ganti ini dengan atribut atau variabel yang sesuai.

                // Tanggal putusan yang diinginkan
                $tanggal_putusan = $item->sidang_pertama;  // Ganti ini dengan atribut atau variabel yang sesuai.



                // Periksa apakah tanggal hasil lebih besar dari tanggal putusan
                if ($tanggal_hasil > $tanggal_putusan) {
                    echo "Data tidak valid";
                } else {
                    echo $tanggal_hasil;
                }
                ?>
            </td>




            <td>{{ $item->pekerjaan }}</td>
            <td>
                @if (strpos($item->pekerjaan, 'PNS') !== false || strpos($item->pekerjaan,
                'Pegawai Negeri Sipil') !== false)
                * *
                @elseif (strpos($item->pekerjaan, 'Pensiunan') !== false)
                #
                @else
                {{ '' }}
                @endif
            </td>
            <td>{{ $item->alamat_pihak2 }}</td>
            <td>
                <?php echo ($item->prodeo == 1) ? '#' : ''; ?>
            </td>
            <td>{{ $item->email_pihak1 }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data yang tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>
