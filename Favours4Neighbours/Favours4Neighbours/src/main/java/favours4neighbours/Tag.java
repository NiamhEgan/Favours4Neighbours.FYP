/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package favours4neighbours;

import java.io.Serializable;
import java.util.Collection;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.JoinTable;
import javax.persistence.ManyToMany;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

/**
 *
 * @author Niamh
 */
@Entity
@Table(name = "tag")
@NamedQueries({
	@NamedQuery(name = "Tag.findAll", query = "SELECT t FROM Tag t"),
	@NamedQuery(name = "Tag.findById", query = "SELECT t FROM Tag t WHERE t.id = :id"),
	@NamedQuery(name = "Tag.findByName", query = "SELECT t FROM Tag t WHERE t.name = :name")})
public class Tag implements Serializable {

	private static final long serialVersionUID = 1L;
	@Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "Id")
	private Integer id;
	@Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 45)
    @Column(name = "Name")
	private String name;
	@ManyToMany(mappedBy = "tagCollection")
	private Collection<Job> jobCollection;
	@JoinTable(name = "userjobskill", joinColumns = {
    	@JoinColumn(name = "Tag_Id", referencedColumnName = "Id")}, inverseJoinColumns = {
    	@JoinColumn(name = "User_Id", referencedColumnName = "Id")})
    @ManyToMany
	private Collection<User> userCollection;

	public Tag() {
	}

	public Tag(Integer id) {
		this.id = id;
	}

	public Tag(Integer id, String name) {
		this.id = id;
		this.name = name;
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public Collection<Job> getJobCollection() {
		return jobCollection;
	}

	public void setJobCollection(Collection<Job> jobCollection) {
		this.jobCollection = jobCollection;
	}

	public Collection<User> getUserCollection() {
		return userCollection;
	}

	public void setUserCollection(Collection<User> userCollection) {
		this.userCollection = userCollection;
	}

	@Override
	public int hashCode() {
		int hash = 0;
		hash += (id != null ? id.hashCode() : 0);
		return hash;
	}

	@Override
	public boolean equals(Object object) {
		// TODO: Warning - this method won't work in the case the id fields are not set
		if (!(object instanceof Tag)) {
			return false;
		}
		Tag other = (Tag) object;
		if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
			return false;
		}
		return true;
	}

	@Override
	public String toString() {
		return "favours4neighbours.Tag[ id=" + id + " ]";
	}
	
}
