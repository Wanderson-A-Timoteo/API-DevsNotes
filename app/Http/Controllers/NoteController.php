<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    private $array = ['error' => '', 'result' => []];

    public function list()
    {
        $notes = Note::all();

        foreach ($notes as $note) {
            $this->array['result'][] = [
                'id' => $note->id,
                'title' => $note->title
            ];
        }

        return $this->array;
    }

    public function NoteDetails($id)
    {
        $note = Note::find($id);

        if ($note) {
            $this->array['result'] = $note;
        } else {
            $this->array['error'] = 'ID não encontrado';
        }

        return $this->array;
    }

    public function create(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');

        if ($title && $body) {
            $note = new Note();
            $note->title = $title;
            $note->body = $body;
            $note->save();

            $this->array['result'] = [
                'id' => $note->id,
                'title' => $title,
                'body' => $body
            ];
        } else {
            $this->array['error'] = 'ID não encontrado';
        }

        return $this->array;
    }

    // Função para editar uma anotação
    // Request $request pega as informações enviadas pelo corpo da requisição e
    // $id é pego da url por isso precisa passar como parametro da função
    public function edit(Request $request, $id)
    {
        $title = $request->input('title'); // pega o titulo da request
        $body = $request->input('body'); // pega o body da request

        // Verifica se os 3 elementos foram enviados, se não ocorre o erro "Campos não enviados"
        if ($id && $title && $body) {

            // Se todos os 3 foram enviados, é preciso verificar se o id corresponde a uma nota no Banco de Dados
            $note = Note::find($id);

            // Se tá no BD pega as informações da anotação, se não ocorre o erro "ID inexistente
            if ($note) {
                $note->title = $title; // Altera o titulo
                $note->body = $body; // Altera o body
                $note->save(); // Salva as alterações

                // Retorna com as novas informações
                $this->array['result'] = [
                    'id' => $id,
                    'title' => $title,
                    'body' => $body
                ];
            } else {
                $this->array['error'] = 'ID inexistente';
            }
        } else {
            $this->array['error'] = 'Campos não enviados';
        }
        return $this->array;
    }

    // Recebe o id da anotação que deseja excluir
    public function delete($id)
    {
        // Pega a anotação
        $note = Note::find($id);

        // Se existir deleta, se não ocorre o erro "ID inexistente"
        if ($note) {
            $note->delete();
        } else {
            $this->array['error'] = 'ID inexistente';
        }
        return $this->array;
    }
}
