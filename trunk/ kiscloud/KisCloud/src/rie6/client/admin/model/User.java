package rie6.client.admin.model;

public class User {
	
	private String id;
	private String login;
	private String mdp;
	private String prenom;
	private String mail;
	private String status;
	
	public User (String id, String login, String mdp, String prenom, String mail, String status){
		
		this.id = id;
		this.login = login;
		this.prenom = prenom;
		this.mail = mail;
		this.status = status;	
	}

	
	//*****  GETTEURS ****
	
	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getLogin() {
		return login;
	}

	public void setLogin(String login) {
		this.login = login;
	}

	public String getMdp() {
		return mdp;
	}

	public void setMdp(String mdp) {
		this.mdp = mdp;
	}

	public String getPrenom() {
		return prenom;
	}

	public void setPrenom(String prenom) {
		this.prenom = prenom;
	}

	public String getMail() {
		return mail;
	}

	public void setMail(String mail) {
		this.mail = mail;
	}

	public String getStatus() {
		return status;
	}

	public void setStatus(String status) {
		this.status = status;
	}

	
	
}

