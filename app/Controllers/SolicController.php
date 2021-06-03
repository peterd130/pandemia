<?php

namespace App\Controllers;

use App\Models\SolicModel;

class SolicController extends BaseController{

	//Retorna a view inicial de solicitações para realizar a busca
	function index() {
		return view('solic_view');
	}

	//Retorna a view  de solicitações com os resultados da busca baseada pelo cpf
	function busca() {
		$solicModel = new SolicModel();

		$data['solic'] = $solicModel->where('cpf', $this->request->getVar('cpf'))->orderBy('id')->findAll();

		return view('solic_view', $data);
	}

	//realiza o cancelamento de uma solicitação e devolve a view de solicitações atualizada
	function cancelar() {
		$solicModel = new SolicModel();
        $id = $this->request->getVar('id');
        $data = [
            'STATUS' => 'CANCELADO'
        ];
        $solicModel->update($id, $data);

		$data['solic'] = $solicModel->where('cpf', $this->request->getVar('cpf'))->orderBy('id')->findAll();

		return view('solic_view', $data);
	}

	//altera o status de uma solicitação  para 'concluido' e devolve a view de solicitações atualizada
	function recebido() {
		$solicModel = new SolicModel();
        $id = $this->request->getVar('id');
        $data = [
            'STATUS' => 'CONCLUIDO'
        ];
        $solicModel->update($id, $data);

		$data['solic'] = $solicModel->where('cpf', $this->request->getVar('cpf'))->orderBy('id')->findAll();

		return view('solic_view', $data);
	}


	//retorna o formulário para criação de nova solicitação
	function form() {
        return view('solic_form');
    }

	//recebe os dados do formulário de solicitação, calcula o prazo de entrega baseado nas solicitações existentes e salva no banco de dados
	function nova() {
        $solicModel = new SolicModel();

		$array = ['TIPO' => $this->request->getVar('tipo'), 'STATUS' => 'PENDENTE'];
		$tam = count($solicModel->where($array)->findAll());
		$date=date_create(date("Y-m-d"));
		date_add($date,date_interval_create_from_date_string(strval(floor(($tam / 4)) + 1) . " days"));
		$entrega = date_format($date,"Y-m-d");
		
        $solicModel->save([
            'NOME' => $this->request->getVar('nome'),
            'CPF'  => $this->request->getVar('cpf'),
			'DATAENTREG'  => $entrega,
			'DATACONTAM'  => $this->request->getVar('datacontam'),
			'DATAMELHORA'  => empty($this->request->getVar('datamelhora')) ? null : $this->request->getVar('datamelhora'),
			'TIPO'  => $this->request->getVar('tipo')
        ]);
        return $this->response->redirect(site_url('/'));
    }

	//retorna a view de relatorios baseado na opção escolhida
	function relatorios() {
		$solicModel = new SolicModel();

		if (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios') == 0) {
			$data['solic'] = $solicModel->orderBy('id')->findAll();
		} elseif (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios/pendentes') == 0) {
			$data['solic'] = $solicModel->where('status', 'PENDENTE')->orderBy('id')->findAll();
		} elseif (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios/concluidos') == 0) {
			$data['solic'] = $solicModel->where('STATUS', "CONCLUIDO")->orderBy('id')->findAll();
		} elseif (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios/cancelados') == 0) {
			$data['solic'] = $solicModel->where('STATUS', "CANCELADO")->orderBy('id')->findAll();
		}

		return view('relatorios', $data);
	}
}

?>