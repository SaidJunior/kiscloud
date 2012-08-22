package rie6.client.admin.model;

import java.util.ArrayList;
import java.util.List;

import rie6.client.admin.controleur.ControllerAdmin;

import com.google.gwt.user.client.ui.Grid;

public class GridTitle extends Grid{
	
	private List<String> listFields  = new ArrayList<String>();
	
	
	
	public GridTitle(){
		
		
		this.setStyleName("gridTitle");
		
		String checkbox = "    ";
		String  id = "Id";
		String login = "Login";
		String password = "Password";
		String nom = "Nom";
		String prenom = "Prenom";	
		String mail = "Mail";
		String Status = "Status";
		
		
		listFields.add(checkbox);
		listFields.add(id);
		listFields.add(login);
		listFields.add(password);
		listFields.add(nom);
		listFields.add(prenom);
		listFields.add(mail);
		listFields.add(Status);
	
		
		for (int row = 0; row < 1; ++row) {
			
		      for (int col = 0; col < listFields.size(); ++col)
		    	  
		    	 // this.setText(col, col, listFields.get(col));
		     // this.setText(row, col, listFields.get(col));
		      this.setTitle( listFields.get(col));
		    }
		
	
		
	}
	
	
	//*************  GETTEURS SETTEURS ***************//

	public List getListChamps() {
		return listFields;
	}

	public void setListChamps(List listChamps) {
		this.listFields = listChamps;
	}
	
	

}
