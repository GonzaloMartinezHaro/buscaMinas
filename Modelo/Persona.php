<?php

Class Persona{

    public $id;
    public $password;  
    public $nombre;
    public $email;
    public $partidasGanadas;
    public $partidasJugadas;
	public $admin;

	public function __construct($id, $password, $nombre, $email, $partidasGanadas, $partidasJugadas, $admin) {

		$this->id = $id;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->partidasGanadas = $partidasGanadas;
		$this->partidasJugadas = $partidasJugadas;
		$this->admin = $admin;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($value) {
		$this->password = $value;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($value) {
		$this->email = $value;
	}

	public function getPartidasGanadas() {
		return $this->partidasGanadas;
	}

	public function setPartidasGanadas($value) {
		$this->partidasGanadas = $value;
	}

	public function getPartidasJugadas() {
		return $this->partidasJugadas;
	}

	public function setPartidasJugadas($value) {
		$this->partidasJugadas = $value;
	}

	public function getAdmin() {
		return $this->admin;
	}

	public function setAdmin($value) {
		$this->admin = $value;
	}
}