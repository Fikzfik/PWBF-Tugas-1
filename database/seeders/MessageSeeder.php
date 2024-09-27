<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\MessageKategori;
use App\Models\MessageTo;
use App\Models\MessageDokumen;
use App\Models\User;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $kategori1 = MessageKategori::create([
            'description' => 'Kategori Umum',
        ]);

        $kategori2 = MessageKategori::create([
            'description' => 'Kategori Penting',
        ]);
        $users1 = User::find(1);
        $users2 = User::find(2);

        $massage1 = Message::create([
            'massage_reference' => 'REF001',
            'subject' => 'Pesan Pertama',
            'text' => 'Ini adalah pesan pertama.',
            'massage_text' => 'Isi pesan lengkap pertama.',
            'massage_status' => 'dikirim',
            'no_mk' => $kategori1->no_mk, // Hubungkan dengan kategori
            'user_id' => $users1->user_id, // Pilih random user
        ]);

        $massage2 = Message::create([
            'massage_reference' => 'REF002',
            'subject' => 'Pesan Kedua',
            'text' => 'Ini adalah pesan kedua.',
            'massage_text' => 'Isi pesan lengkap kedua.',
            'massage_status' => 'diterima',
            'no_mk' => $kategori2->no_mk,
            'user_id' => $users2->user_id,
        ]);

        // Buat massage_to
        MessageTo::create([
            'to' => $users1->email,
            'cc' => $users2->email,
            'massage_id' => $massage1->massage,
        ]);

        MessageTo::create([
            'to' => $users2->email,
            'cc' => $users1->email,
            'massage_id' => $massage2->massage_id,
        ]);

        // Buat massage_dokumen
        MessageDokumen::create([
            'file' => 'dokumen1.pdf',
            'description' => 'Dokumen untuk pesan pertama.',
            'massage_id' => $massage1->massage_id,
        ]);

        MessageDokumen::create([
            'file' => 'dokumen2.pdf',
            'description' => 'Dokumen untuk pesan kedua.',
            'massage_id' => $massage2->massage_id,
        ]);
    }
}
