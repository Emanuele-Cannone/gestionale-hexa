<?php

namespace Database\Seeders;

use App\Models\Progen\ProgenFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgenFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgenFeature::create([
            'name' => 'abilita tasto chiamata',
            'description' => 'Abilita il tasto di chiamata',
        ]);
        ProgenFeature::create([
            'name' => 'abilita info istruzioni',
            'description' => 'Abilita informazioni lavorazione'
        ]);
        ProgenFeature::create([
            'name' => 'invio sms',
            'description' => 'Abilita il tasto di invio sms'
        ]);
        ProgenFeature::create([
            'name' => 'switch pratica',
            'description' => 'Abilita switch pratica in altro contesto'
        ]);
        ProgenFeature::create([
            'name' => 'scelta pratica',
            'description' => 'Abilita scelta pratica da elenco'
        ]);
        ProgenFeature::create([
            'name' => 'accesso ricaduta',
            'description' => 'Abilita accesso in ricaduta personale in qualsiasi orario'
        ]);
        ProgenFeature::create([
            'name' => 'dati aggiuntivi obbligatori',
            'description' => 'Abilita obbligo inserimento dati aggiuntivi'
        ]);
        ProgenFeature::create([
            'name' => 'autocompletamento dati aggiuntivi',
            'description' => 'Abilita auto completamento ultimo inserimento dati aggiuntivi'
        ]);
        ProgenFeature::create([
            'name' => 'orario richiamata dinamico',
            'description' => 'Abilita orario chiamata dinamico'
        ]);
        ProgenFeature::create([
            'name' => 'posticipo chiamata',
            'description' => 'Abilita tasto posticipo chiamata di ore'
        ]);
        ProgenFeature::create([
            'name' => 'ordinamento',
            'description' => 'Ordinamento pratica dalla meno recente'
        ]);
        ProgenFeature::create([
            'name' => 'conteggio giorni',
            'description' => 'Conteggio giorni da data prossima chiamata valore default oggi'
        ]);
        ProgenFeature::create([
            'name' => 'esclusione automatica',
            'description' => 'Le pratiche con i valori selezionati verranno escluse dalla lavorazione'
        ]);
    }
}
