package rie6.serveur.model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import rie6.serveur.controleur.ControleurServeur;

public class TestCookie {
	private ControleurServeur controleurServeur;
	private Connection connect = null;
	private Statement statement = null;
	private ResultSet resultSet = null;
	private String[] retour=new String[7];		// tableau avec les identifiants de l'user
	
	/**
	 * Test l'id de session reçu dans la base
	 * @param controleurServeur 
	 * @param sessionID
	 */
	public TestCookie(ControleurServeur controleurServeur, String sessionID) {
		this.controleurServeur=controleurServeur;
		try {
			//preparation du driver JAR
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			 // init de la connexion
		    connect = DriverManager.getConnection("jdbc:mysql://localhost:3306/KISCLOUD?user=root&password="+controleurServeur.getMdpBDD());
			// Statements pour authoriser les requettes SQL
		    statement = connect.createStatement();
		    // ecriture et execution de la requete
		    resultSet = statement	.executeQuery("select * from KISCLOUD.USERS where id_cookie= '"+sessionID+"'");
		    
		    //on se positionne sur la derniere ligne de resultat. Il doit en avoir qu'une si le login et pass existe
		    resultSet.last();
		    if (resultSet.getRow()==0){
			   //alors l'id n'existe pas on retour null pour afficher le formulaire de login
		    	this.retour[0]=null;
		    }else{
		    	//c'est ok. on recup les info user
		    	retour[0]=resultSet.getString("id_user");
		    	retour[1]=resultSet.getString("login_user");
		    	retour[2]=resultSet.getString("nom_user");
		    	retour[3]=resultSet.getString("prenom_user");
		    	retour[4]=resultSet.getString("mail_user");
		    	retour[5]=resultSet.getString("status_user");
		    	retour[6]=resultSet.getString("id_cookie");
		    	
		    }
		    	
		    statement.close();
		    
		} catch (InstantiationException e) {
			e.printStackTrace();
		} catch (IllegalAccessException e) {
			
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			
			e.printStackTrace();
		} catch (SQLException e) {
			
			e.printStackTrace();
		}
		
		
	}
	/**
	 * Retourne les informations sur l'utilisateurs dans un tableau
	 * @return
	 * 			Tableau de String[5]
	 */
	public String[] getRetour() {
		return retour;
	}

}
