/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package favours4neighbours;

import java.io.Serializable;
import java.util.Collection;
import javax.persistence.Basic;
import javax.persistence.CascadeType;
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
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

/**
 *
 * @author Niamh
 */
@Entity
@Table(name = "user")
@NamedQueries({
	@NamedQuery(name = "User.findAll", query = "SELECT u FROM User u"),
	@NamedQuery(name = "User.findById", query = "SELECT u FROM User u WHERE u.id = :id"),
	@NamedQuery(name = "User.findByUsername", query = "SELECT u FROM User u WHERE u.username = :username"),
	@NamedQuery(name = "User.findByPassword", query = "SELECT u FROM User u WHERE u.password = :password"),
	@NamedQuery(name = "User.findByEmail", query = "SELECT u FROM User u WHERE u.email = :email"),
	@NamedQuery(name = "User.findByActive", query = "SELECT u FROM User u WHERE u.active = :active")})
public class User implements Serializable {

	private static final long serialVersionUID = 1L;
	@Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "Id")
	private Integer id;
	@Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 45)
    @Column(name = "Username")
	private String username;
	@Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 255)
    @Column(name = "Password")
	private String password;
	// @Pattern(regexp="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?", message="Invalid email")//if the field contains email address consider using this annotation to enforce field validation
	@Size(max = 45)
    @Column(name = "email")
	private String email;
	@Basic(optional = false)
    @NotNull
    @Column(name = "Active")
	private short active;
	@JoinTable(name = "userrolelink", joinColumns = {
    	@JoinColumn(name = "UserId", referencedColumnName = "Id")}, inverseJoinColumns = {
    	@JoinColumn(name = "UserRoleId", referencedColumnName = "Id")})
    @ManyToMany
	private Collection<UserRole> userRoleCollection;
	@ManyToMany(mappedBy = "userCollection")
	private Collection<Tag> tagCollection;
	@OneToMany(cascade = CascadeType.ALL, mappedBy = "createdBy")
	private Collection<Job> jobCollection;

	public User() {
	}

	public User(Integer id) {
		this.id = id;
	}

	public User(Integer id, String username, String password, short active) {
		this.id = id;
		this.username = username;
		this.password = password;
		this.active = active;
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public short getActive() {
		return active;
	}

	public void setActive(short active) {
		this.active = active;
	}

	public Collection<UserRole> getUserRoleCollection() {
		return userRoleCollection;
	}

	public void setUserRoleCollection(Collection<UserRole> userRoleCollection) {
		this.userRoleCollection = userRoleCollection;
	}

	public Collection<Tag> getTagCollection() {
		return tagCollection;
	}

	public void setTagCollection(Collection<Tag> tagCollection) {
		this.tagCollection = tagCollection;
	}

	public Collection<Job> getJobCollection() {
		return jobCollection;
	}

	public void setJobCollection(Collection<Job> jobCollection) {
		this.jobCollection = jobCollection;
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
		if (!(object instanceof User)) {
			return false;
		}
		User other = (User) object;
		if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
			return false;
		}
		return true;
	}

	@Override
	public String toString() {
		return "favours4neighbours.User[ id=" + id + " ]";
	}
	
}
