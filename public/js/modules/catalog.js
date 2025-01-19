"use strict";
import Home from './home.js';

export default class Catalog extends Home {

  distinctSections(categories){
    let mapped = [...categories.map(item => item.section)];
    let unique = [...new Set(mapped)];
    return unique
  }

  liElement = obj => `<li><a class="reset-anchor category-item" href="#!" data-id="${obj.id}">${obj.name}</a></li>`;

  ulElement = items => {
    let ul = document.createElement('ul');
    ul.setAttribute('class', "list-unstyled categories small text-muted");
    let res = '';
    for (let item of items) {
        res += this.liElement(item);
    }
    ul.innerHTML = res;
    return ul;
  }

  categoriesCollation(distinct, categories) {
    let results = [];
    let i = 0;
    
    for (let section of distinct) {
        results[i] = categories.filter(obj => obj.section === section);
        i++;
    }
    return results;
  }
  
  sectionName = section => {
    let div = document.createElement('div');
    div.setAttribute('class', "py-2 px-4 bg-dark text-white mb-3"); 
    div.innerHTML = `<strong class="small text-uppercase fw-bold">${section}</strong>`;
    return div;
  }

  populateCategories(categoryContainer, categories) {
    let distinct = this.distinctSections(categories);
    let collation = this.categoriesCollation(distinct, categories);

    for (let i = 0; i < distinct.length; i++) {
        categoryContainer.append(this.sectionName(distinct[i]));
        categoryContainer.append(this.ulElement(collation[i]));
    } 
  }

// ==============================================

badgeTemplate = item => `<div class="form-check mb-1"><input class="form-check-input" type="checkbox" id="id-${item}" value="${item}" name="badge"><label class="form-check-label" for="id-${item}">${item}</label></div>`;

renderList = (products, value) => this.populateProductList(products.filter(product => product.badge.includes(value)));


populateBadges(products) {

  let badges = [...new Set([...products.map(item => item.badge)].filter(item => item != ''))];
  return badges.map(item => this.badgeTemplate(item)).join(" ");
}

  sortingOrders = [
    {key:"default", value: "Default sorting"}, 
    {key:"popularity", value:"Popularity Products"}, 
    {key:"low-high", value:"Low to High Price"}, 
    {key:"high-low", value:"High to Low Price"}
  ];

  sortingOptions = () => this.sortingOrders.map(item => `<option value="${item.key}">${item.value}</option>`).join(' ');

  compare = (key, order='acs') => (a, b) => {
    if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) return 0;
    const A = (typeof a[key] === 'string') ? a[key].toUpperCase() : a[key];
    const B = (typeof b[key] === 'string') ? b[key].toUpperCase() : b[key];

    let comparison = 0;
    comparison = (A > B) ? 1 : -1;
    
    return (order === 'desc') ? -comparison : comparison;
  }
}
