<?php

namespace Tests\Unit;

use App\Http\Controllers\PerkaraLipa1Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class PerkaraLipa1ControllerTest extends TestCase
{
    public function test_index_method_returns_view_with_expected_data(): void
    {
        // Arrange
        $controller = new PerkaraLipa1Controller();
        $request = new Request();
        $request->merge(['tahun' => '2022', 'bulan' => '01', 'jenis_perkara' => 'Pdt.G']);

        // Act
        $response = $controller->index($request);

        // Assert
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertArrayHasKey('result', $response->getData());
        $this->assertArrayHasKey('bulan', $response->getData());
        $this->assertArrayHasKey('tahun', $response->getData());
        $this->assertArrayHasKey('jenis_perkara', $response->getData());
        $this->assertArrayHasKey('selectedBulan', $response->getData());
        $this->assertArrayHasKey('selectedTahun', $response->getData());
        $this->assertArrayHasKey('request', $response->getData());
    }

    public function test_index_method_queries_database_with_expected_conditions(): void
    {
        // Arrange
        $controller = new PerkaraLipa1Controller();
        $request = new Request();
        $request->merge(['tahun' => '2022', 'bulan' => '01', 'jenis_perkara' => 'Pdt.G']);

        // Mock the DB facade
        DB::shouldReceive('table')
            ->once()
            ->with('perkara')
            ->andReturnSelf();
        DB::shouldReceive('select')
            ->once()
            ->andReturn([]);

        // Act
        $controller->index($request);

        // Assert
        DB::shouldReceive('select')
            ->once()
            ->with([
                'select' => [
                    'nomor_perkara',
                    'majelis_hakim_nama',
                    'panitera_pengganti_text',
                    'tanggal_pendaftaran',
                    'penetapan_majelis_hakim',
                    'penetapan_hari_sidang',
                    'sidang_pertama',
                    'tanggal_putusan',
                    'status_putusan_nama',
                    'pekerjaan',
                    'perkara_pihak2.alamat as alamat_pihak2',
                    'prodeo',
                    'pihak.email as email_pihak1',
                ],
                'from' => 'perkara',
                'leftJoin' => [
                    'perkara_penetapan' => 'perkara.perkara_id = perkara_penetapan.perkara_id',
                    'perkara_putusan' => 'perkara.perkara_id = perkara_putusan.perkara_id',
                    'perkara_pihak1' => 'perkara.perkara_id = perkara_pihak1.perkara_id',
                    'perkara_pihak2' => 'perkara.perkara_id = perkara_pihak2.perkara_id',
                    'pihak' => 'perkara_pihak1.pihak_id = pihak.id',
                ],
                'where' => [
                    function ($query) {
                        $query->whereRaw("(YEAR(tanggal_pendaftaran) = ? AND MONTH(tanggal_pendaftaran) = ?)", ['2022', '01'])
                            ->orWhereRaw("(YEAR(penetapan_majelis_hakim) = ? AND MONTH(penetapan_majelis_hakim) = ?)", ['2022', '01'])
                            ->orWhereRaw("(YEAR(penetapan_hari_sidang) = ? AND MONTH(penetapan_hari_sidang) = ?)", ['2022', '01'])
                            ->orWhereRaw("(YEAR(sidang_pertama) = ? AND MONTH(sidang_pertama) = ?)", ['2022', '01'])
                            ->orWhereRaw("(YEAR(tanggal_putusan) = ? AND MONTH(tanggal_putusan) = ?)", ['2022', '01'])
                            ->orWhereNull('tanggal_pendaftaran');
                    },
                    ['perkara.nomor_perkara', 'like', '%Pdt.G%'],
                    ['perkara_pihak1.urutan', '1'],
                    function ($query) {
                        $query->where('pekerjaan', 'like', '%PNS%')
                            ->orWhere('pekerjaan', 'like', '%Pegawai Negeri Sipil%')
                            ->orWhere('perkara_pihak2.alamat', 'like', '%tidak diketahui%')
                            ->orWhere('prodeo', '1');
                    },
                    ['pekerjaan', 'not like', '%Pensiunan%'],
                ],
                'orderBy' => ['tanggal_pendaftaran'],
            ]);

        // Verify that the DB facade was called as expected
        DB::verify();
    }
}
