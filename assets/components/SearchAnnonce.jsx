import "react-loader-spinner/dist/loader/css/react-spinner-loader.css";

import React, { useRef, useState } from "react";

import Highlighter from "react-highlight-words";
import { IoCloseCircleSharp } from "react-icons/io5";

import Loader from "react-loader-spinner";
import axios from "axios";

export function SearchAnnonce() {
  const timerRef = useRef(null);
  const [results, setResults] = useState([]);
  const [query, setQuery] = useState("");
  const [searching, setSearching] = useState(false);
  const [showList, setShowList] = useState(false);
  const handleRequest = async (search) => {

    if (search) {
      const response = await axios.get(
        `/annonces/api/search/${encodeURIComponent(search)}`
      );
      console.log("🚀 ~ file: SearchAnnonce.jsx", response.data);
      setResults(response.data);
      setSearching(false);
    }
  };
  const handleClick = () => {
    !showList && query.length > 0 && setShowList(true);
  };
  const handleChange = (e) => {
    let searchText = e.target.value;
    setSearching(true);
    setShowList(searchText);
    setQuery(searchText);
    timerRef.current && clearTimeout(timerRef.current);
    timerRef.current = setTimeout(() => {
      handleRequest(searchText);
    }, 1000);
  };
  const handleKeyDown = (e) => {
    console.log(e);
    e.keyCode === 27 &&
      (query.length > 0 && !showList ? setQuery("") : setShowList(false));
    timerRef.current && clearTimeout(timerRef.current);
  }; 
  const clearSearch = () => {
    setSearching(false);
    setShowList(false);
    setQuery("");
  };
  const handleSelect = (id) => {

    console.log(`Vous avez cliqué sur : ${id}`);
    setShowList(false);
  };
  return (
        <>
      <div className="searchContainer">
        {query && (
          <IoCloseCircleSharp onClick={clearSearch} className="searchIcon" />
        )}

        <input
          className="searchBox"
          type="text"
          value={query}
          placeholder="Votre region ..."
          style={{ width: "40%", padding:"3px", borderRadius:"15px", border: "none" }}
          name="search_authors"
          onChange={handleChange}
          onKeyDown={handleKeyDown}
          onClick={handleClick}
        />
        
      </div>

      {showList && (
            <>
              <div style={{
              width: "100%",
              margin: "50px",
              width: "inherit",
              }} className="row"
              >

            {results.length > 0 && !searching ? (
              results.map((res, index) => {
                return (
                      <>

                    <div key={index} className="card resultLine col-12 col-md-6 col-lg-4 m-2 " style={{width:"16rem", backgroundColor:"#deeaee"}} onClick={() => handleSelect(res.id)} >
                      <a href={`/annonces/${res.id}`} rel="noopener noreferrer">
                      <img src={`/images/${res.img1}`} className="card-img-top m-1" alt=""></img>
                      </a>
                      <div className="card-body">
                        <h5 className="card-title">{res.type_logement} - {res.superficie}m²</h5>
                        <p className="card-text">Ragion : {res.region}</p>
                        <p className="card-text">{res.description}</p>
                        <p className="card-text">{res.user.nom} <img src={`images/${res.user.img_avatar}`} class="img-thumbnail w-25" alt=""></img></p>
                        
                        <a href={`/annonces/${res.id}`} className="btn btn-primary">{res.prix}€/mois</a>
                      </div>

                    </div>
                  </>
                    );
                  })
                ) : !searching && query ? (
                  
                    <p>Aucun résultat</p>
                  
                ) : (
                  <p>
                      <Loader
                        type="ThreeDots"
                        color="#8BCAD4"
                        height={40}
                        width={40}
                      />
                  </p>
                )}
            </div>
            </>
          )}
        </>
      );

}