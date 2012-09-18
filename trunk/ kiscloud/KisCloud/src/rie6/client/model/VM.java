package rie6.client.model;

import java.util.ArrayList;

import com.google.gwt.user.client.rpc.IsSerializable;

/**
 * Une machine virtuelle
 * @author nico
 *
 */
public class VM implements IsSerializable{
	//**********************
	// Variables
	//**********************
	private int id,nbCore, ram;
	private String status,isoName;
	private ArrayList<String>listDisk = new ArrayList<String>();	// liste des noms des disques dur rattachés a la vm
	
	//**********************
	// Constructeur
	//**********************
	public VM(){
		
	}
	public VM(int id, int nbCore, int ram,String status,String isoName, ArrayList<String>listDisk){
		this.setId(id);
		this.nbCore=nbCore;
		this.ram=ram;
		this.listDisk=listDisk;
		this.status=status;
		this.setIsoName(isoName);
	}
	//**********************
	// Getter et setter
	//**********************
	public int getNbCore() {
		return nbCore;
	}
	public void setNbCore(int nbCore) {
		this.nbCore = nbCore;
	}
	public int getRam() {
		return ram;
	}
	public void setRam(int ram) {
		this.ram = ram;
	}
	public ArrayList<String> getListDisk() {
		return listDisk;
	}
	public void setListDisk(ArrayList<String> listDisk) {
		this.listDisk = listDisk;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getIsoName() {
		return isoName;
	}
	public void setIsoName(String isoName) {
		this.isoName = isoName;
	}
	
	//**********************
	// Methodes
	//**********************

}
