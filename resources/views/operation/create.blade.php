@extends('layouts.app')

@section('title', 'Choisissez les travaux à effectuer')

@section('content')

<div class="title">
    <h1>Choisissez les travaux à effectuer</h1>
</div>

<div class="estimate-construction">

    <div class="w50">
        <div id="room-row">
        
            <div>
                <label for="select-materials">Fourniture : </label>

                <select name="material" id="select-materials">
                    @foreach ($materials as $material)
                    <option value="{{ $material->id }}" data-unit_price="{{ $material->unit_price }}" data-workforce_price="{{ $material->workforce_price }}">{{ ucfirst($material->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="input-quantity">Quantité : </label>
                <input class="w25" id="input-quantity" value="1" type="number" min="1">
            </div>

            <div>
                <button id="add-room-btn" type="button"><i class="fas fa-plus"></i></button>
            </div>
        </div>

        <form class="border m-auto" method="POST" id="estimate-form" action="{{ route('operation.store', ['estimate' => $estimate,'location_of_work' => $location_of_work]) }}">
            @csrf

            <div class="form-content">
                <div class="form-row">
                    <div class="form-columns">

                        <div class="h2-title">
                            <h2>{{ ucfirst(strtolower($location_of_work->room->name)) }}</h2>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-content">
                <div class="form-row">
                    <div class="form-columns">

                        <div id="div-works">

                        </div>

                    </div>
                </div>
            </div>

            <div class="form-content">
                <div class="form-row" style="align-items:center; border-top: 1px solid var(--dark-blue); border-bottom: 1px solid var(--dark-blue); margin: 10px">
                    <div class="form-columns">

                        <div>
                            Total fournitures : <span id="furnitures_cost"></span> €
                            <input id="supplies"
                                type="hidden"
                                name="supplies"
                                value="{{ old('supplies') }}"
                                class="@error('supplies') is-invalid @enderror">
                        </div>
                    </div>
                
                    <div class="form-columns" style="text-align:right;">
                        <div>
                            <label for="subtotal">Total travaux : </label>
                    
                            <input id="subtotal"
                                style="margin-right:5px;"
                                type="number"
                                name="subtotal"
                                value="{{ old('subtotal') }}"
                                class="input-operations @error('subtotal') is-invalid @enderror">€
                            
                            @error('subtotal')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="form-content">
                <div class="form-row" style="align-items:center; margin: 10px">
                    <div>Garantie fournitures et matériaux : </div>
            
                    <div>
                        <input style="width: 50px; margin-right:5px; text-align:center;" id="warranty"
                            type="number"
                            name="warranty"
                            value="{{ old('warranty', $location_of_work->warranty) }}"
                            class="@error('warranty') is-invalid @enderror">ans
                        
                        @error('warranty')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-button end">
                <button type="submit">Validez</button>
            </div>
            
        </form>
    </div>
</div>

<script>
    // VARIABLES
    let works = document.getElementById('div-works');
    let selectedMaterial = document.getElementById('select-materials');
    let selectedQuantity = document.getElementById('input-quantity');
    let addRoomBtn = document.getElementById('add-room-btn');
    let furnituresCost = document.getElementById('furnitures_cost');
    let inputSupplies = document.getElementById('supplies');
    let worksCost = document.getElementById('subtotal');

    let furnitures = [];
    let workforces = [];

    // FUNCTIONS
    function addRow(){
        let newRow = document.createElement("div");
        newRow.classList.add("selected-row");
        
        works.appendChild(newRow);

        // MATERIAL
        let materialDiv = document.createElement("div");
        materialDiv.innerText = "Fourniture : " + selectedMaterial.options[selectedMaterial.selectedIndex].text;
        let materialId = selectedMaterial.options[selectedMaterial.selectedIndex].value;

        // QUANTITY
        let quantityDiv = document.createElement("div");
        quantityDiv.innerText = "Quantité : " + selectedQuantity.value;
        let quantityNbr = selectedQuantity.value;

        // FURNITURES INPUT
        let furnitureCostInput = createFurnitureInput();
        furnitureCostInput.value = selectedMaterial.options[selectedMaterial.selectedIndex].dataset.unit_price * quantityNbr;

        // HIDDEN INPUT
        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", selectedMaterial.options[selectedMaterial.selectedIndex].value+'_'+selectedQuantity.value);
        input.value = materialId + '_' + quantityNbr;

        newRow.append(materialDiv, quantityDiv, furnitureCostInput, input, createDeleteBtn());

        furnitures.push(selectedMaterial.options[selectedMaterial.selectedIndex].dataset.unit_price * quantityNbr);
        workforces.push(selectedMaterial.options[selectedMaterial.selectedIndex].dataset.workforce_price * quantityNbr);

        calculate();
        selectedQuantity.value = 1;
        console.log(furnitures);
    }

    function calculate() {
        let sumFurnitures = 0;
        let sumWorkforces = 0;

        for( let i=0; i < furnitures.length; i++)
        {
            sumFurnitures += furnitures[i];
        }
        for( let i=0; i < workforces.length; i++)
        {
            sumWorkforces += workforces[i];
        }

        furnituresCost.innerText = sumFurnitures;
        inputSupplies.value = sumFurnitures;
        worksCost.value = sumFurnitures + sumWorkforces;
    }

    function createDeleteBtn(){
        let buttonDiv = document.createElement("div");
        let deleteButton = document.createElement("button");
        let i = document.createElement("i");

        deleteButton.setAttribute("type", "button");
        i.classList.add("fas", "fa-trash");

        deleteButton.appendChild(i)
        buttonDiv.appendChild(deleteButton);

        deleteButton.addEventListener('click', deleteRow);

        return buttonDiv;
    }

    function createFurnitureInput() {

        let input = document.createElement("input");
        input.setAttribute("type", "number");
        input.classList.add('input-operations');

        input.addEventListener('change', updateFurnitureCost);

        return input;
    }

    function updateFurnitureCost(e){

        let div = e.target.closest("div.selected-row");
        let index = getIndex(div);
        furnitures[index] = parseInt(e.target.value);
        console.log(furnitures);
        calculate();
    }

    function deleteRow(e){

        let div = e.target.closest("div.selected-row");
        let index = getIndex(div);

        if (index === 0) {
            furnitures.shift();
            workforces.shift();
        } else {
            furnitures.splice(index, index);
            workforces.splice(index, index);
        }
        
        div.remove();
        calculate();
    }

    function getIndex(child){
        
        let parent = child.parentNode;
        return Array.prototype.indexOf.call(parent.children, child);
    }


    // CODE
    addRoomBtn.addEventListener('click', addRow);
    calculate();

</script>

@endsection