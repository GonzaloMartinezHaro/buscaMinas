<?php
Class Tablero{

    public $id;
    public $id_usuario;
    public $tableroOculto;
    public $tableroJugador;
    public $finalizado;

	public function __construct($id, $id_usuario, $tableroOculto, $tableroJugador, $finalizado) {

		$this->id = $id;
		$this->id_usuario = $id_usuario;
		$this->tableroOculto = $tableroOculto;
		$this->tableroJugador = $tableroJugador;
		$this->finalizado = $finalizado;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getId_usuario() {
		return $this->id_usuario;
	}

	public function setId_usuario($value) {
		$this->id_usuario = $value;
	}

	public function getTableroOculto() {
		return $this->tableroOculto;
	}

	public function setTableroOculto($value) {
		$this->tableroOculto = $value;
	}

	public function getTableroJugador() {
		return $this->tableroJugador;
	}

	public function setTableroJugador($value) {
		$this->tableroJugador = $value;
	}

	public function getFinalizado() {
		return $this->finalizado;
	}

	public function setFinalizado($value) {
		$this->finalizado = $value;
	}
}