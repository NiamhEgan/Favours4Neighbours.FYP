/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package favours4neighbours;

import java.io.Serializable;
import java.util.Collection;
import java.util.Date;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.JoinTable;
import javax.persistence.ManyToMany;
import javax.persistence.ManyToOne;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

/**
 *
 * @author Niamh
 */
@Entity
@Table(name = "job")
@NamedQueries({
	@NamedQuery(name = "Job.findAll", query = "SELECT j FROM Job j"),
	@NamedQuery(name = "Job.findById", query = "SELECT j FROM Job j WHERE j.id = :id"),
	@NamedQuery(name = "Job.findByDateCreated", query = "SELECT j FROM Job j WHERE j.dateCreated = :dateCreated")})
public class Job implements Serializable {

	private static final long serialVersionUID = 1L;
	@Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "Id")
	private Integer id;
	@Column(name = "DateCreated")
    @Temporal(TemporalType.TIMESTAMP)
	private Date dateCreated;
	@JoinTable(name = "jobtag", joinColumns = {
    	@JoinColumn(name = "Job_Id", referencedColumnName = "Id")}, inverseJoinColumns = {
    	@JoinColumn(name = "Tag_Id", referencedColumnName = "Id")})
    @ManyToMany
	private Collection<Tag> tagCollection;
	@JoinColumn(name = "CreatedBy", referencedColumnName = "Id")
    @ManyToOne(optional = false)
	private User createdBy;

	public Job() {
	}

	public Job(Integer id) {
		this.id = id;
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public Date getDateCreated() {
		return dateCreated;
	}

	public void setDateCreated(Date dateCreated) {
		this.dateCreated = dateCreated;
	}

	public Collection<Tag> getTagCollection() {
		return tagCollection;
	}

	public void setTagCollection(Collection<Tag> tagCollection) {
		this.tagCollection = tagCollection;
	}

	public User getCreatedBy() {
		return createdBy;
	}

	public void setCreatedBy(User createdBy) {
		this.createdBy = createdBy;
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
		if (!(object instanceof Job)) {
			return false;
		}
		Job other = (Job) object;
		if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
			return false;
		}
		return true;
	}

	@Override
	public String toString() {
		return "favours4neighbours.Job[ id=" + id + " ]";
	}
	
}
