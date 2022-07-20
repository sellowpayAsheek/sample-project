<style>
#wrapper {
  margin: 0 auto;
  display: block;
  width: 960px;
}

#pagination {
  margin: 0;
  padding: 0;
  text-align: center
}

#pagination li {
  display: inline
}

#pagination li a {
  display: inline-block;
  text-decoration: none;
  padding: 5px 10px;
  color: #000
}


/* Active and Hoverable Pagination */
#pagination li a {
  border-radius: 5px;
  -webkit-transition: background-color 0.3s;
  transition: background-color 0.3s

}
#pagination li a.active {
  background-color: #4caf50;
  color: #fff
}
#pagination li a:hover:not(.active) {
  background-color: #ddd;
}

.current_active = {
    background-color: #4caf50;
    color: #fff ;
}
</style>
