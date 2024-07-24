<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use SplPriorityQueue;

class HomeController extends Controller
{
    public function index() {

        $mapImage = Route("peta");

        return view("home",[
            "mapImage" => $mapImage
        ]);
    }

    function openstreetmap(Request $request) {
        return view("openstreetmap");
    }

    function itkimap() {
        $mapImage1 = Route("itki1");
        $mapImage2 = Route("itki2");
        // dd($mapImage);
        return view("itkimap",[
            "mapImage1" => $mapImage1,
            "mapImage2" => $mapImage2,
        ]);
    }


    function kawasan() {
        $mapImage = Route("peta-kawasan");
        // dd($mapImage);
        return view("kawasan",[
            "mapImage" => $mapImage
        ]);
    }

    private $graph;
    private $vertices;

    public function __construct() {
        $this->graph = [];
        $this->vertices = [];
    }

    // Method untuk menambahkan edge (sambungan) antara dua titik dalam graf
    public function addEdge($source, $destination, $weight) {
        $this->graph[$source][$destination] = $weight;
        $this->vertices[$source] = true;
        $this->vertices[$destination] = true;
    }

    // Method untuk mencari jalur terpendek menggunakan algoritma Dijkstra
    public function dijkstra($source, $destination) {
        // Array untuk menyimpan jarak terpendek dari titik awal ke setiap titik lain dalam graf
        $distances = [];
        // Array untuk menyimpan informasi titik sebelumnya dalam jalur terpendek
        $previous = [];
        // Antrian prioritas untuk menyimpan simpul-simpul yang akan diproses
        $queue = new SplPriorityQueue();

        // Inisialisasi jarak dari titik awal ke setiap titik lain dengan tak hingga (infinity)
        foreach ($this->vertices as $vertex => $value) {
            $distances[$vertex] = INF;
            // Titik sebelumnya dalam jalur terpendek diatur ke nilai null
            $previous[$vertex] = null;
        }

        // Jarak dari titik awal ke dirinya sendiri diatur ke 0
        $distances[$source] = 0;
        // Masukkan titik awal ke dalam antrian prioritas dengan prioritas 0
        $queue->insert($source, 0);

        // Array untuk menyimpan semua jalur terpendek dari titik awal ke titik tujuan
        $paths = []; // Menyimpan semua jalur terpendek

         // Lakukan loop selama antrian prioritas tidak kosong
        while (!$queue->isEmpty()) {
            // Ambil simpul dengan prioritas tertinggi (jarak terpendek) dari antrian prioritas
            $current = $queue->extract();

             // Jika simpul yang diproses adalah titik tujuan, maka buat jalur terpendek
            if ($current === $destination) {
                $path = [];
                while (isset($previous[$current])) {
                    $path[] = $current;
                    // Perbarui simpul saat ini dengan simpul sebelumnya dalam jalur
                    $current = $previous[$current];
                }
                // Tambahkan titik awal ke jalur
                $path[] = $source;
                // Balik jalur karena jalur dibangun dari tujuan ke sumber
                $paths[] = array_reverse($path);
            }

            // Jika simpul saat ini tidak memiliki tetangga, lanjutkan ke simpul berikutnya
            if (!isset($this->graph[$current])) {
                continue;
            }

            // Iterasi melalui semua tetangga dari simpul saat ini
            foreach ($this->graph[$current] as $neighbor => $weight) {
                // Hitung alternatif jarak terpendek ke tetangga saat ini
                $alt = $distances[$current] + $weight;
                // Jika alternatif jarak lebih pendek dari jarak sebelumnya, perbarui jarak dan titik sebelumnya
                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $current;
                    // Masukkan tetangga ke dalam antrian prioritas dengan prioritas yang sesuai
                    $queue->insert($neighbor, -$alt);
                }
            }
        }
        // Kembalikan semua jalur terpendek yang ditemukan dari titik awal ke titik tujuan
        return $paths;
    }


    function cobaDjitra() {
        // Tambahkan edge antar titik beserta bobotnya
        $this->addEdge('S', 'A', 1);
        $this->addEdge('S', 'B', 2);
        $this->addEdge('A', 'S', 1);
        $this->addEdge('A', 'B', 2);
        $this->addEdge('A', 'D', 1);
        $this->addEdge('A', 'C', 2);
        $this->addEdge('B', 'S', 5);
        $this->addEdge('B', 'A', 2);
        $this->addEdge('B', 'D', 2);
        $this->addEdge('C', 'A', 2);
        $this->addEdge('C', 'D', 3);
        $this->addEdge('C', 'E', 1);
        $this->addEdge('D', 'B', 2);
        $this->addEdge('D', 'A', 1);
        $this->addEdge('D', 'C', 3);
        $this->addEdge('D', 'E', 2);
        $this->addEdge('E', 'C', 1);
        $this->addEdge('E', 'D', 2);
        // Tentukan titik awal dan titik tujuan
        $start = 'B';
        $destination = 'C';

        // Temukan semua jalur terpendek
        $paths = $this->dijkstra($start, $destination);

        if (count($paths) > 0) {
            echo "Semua jalur terpendek dari $start ke $destination: " . PHP_EOL;
            dd($paths);
            foreach ($paths as $path) {
                echo implode(' -> ', $path) . PHP_EOL;
            }
        } else {
            echo "Tidak ada jalur dari $start ke $destination." . PHP_EOL;
        }
    }

}
