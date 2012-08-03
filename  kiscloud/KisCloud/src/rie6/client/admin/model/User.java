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

	public String getLogin() {
		return login;
	}

	public String getMdp() {
		return mdp;
	}

	public String getPrenom() {
		return prenom;
	}

	public String getMail() {
		return mail;
	}

	public String getStatus() {
		return status;
	}
	
	
}

