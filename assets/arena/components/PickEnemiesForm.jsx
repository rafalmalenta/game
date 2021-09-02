import React, {useState} from 'react';
import EnemyInput from './EnemyInput'
import axios from "axios";

const PickEnemiesForm = (props) => {
    const [inputs, setInputs] = useState([0]);
    const maxInputs = 3
    function addInputCount(){
        let freeID ="";
        let takenIDs
        if (inputs.length < maxInputs) {
            takenIDs = inputs.map((input) => {
                return input;
            });
            takenIDs.sort((a, b) => a - b);
            for (let i = 0; i < inputs.length + 1; i++) {
                if (!takenIDs.includes(i)) {
                    freeID = i;
                    break;
                }
            }
            let temp = [...inputs]
            temp.push(freeID);
            setInputs(temp);
        }
    }
    let Inputs=[];
    Inputs = inputs.map((input)=>{
        let alone = false;
        let maxSizeReached = false;
        if (inputs.length === 1)
            alone = true;
        if (inputs.length >= maxInputs)
            maxSizeReached = true;
        return  <EnemyInput key={input} id={input} addInput={addInputCount} removeMe={remove} alone={alone}
                            maxReached={maxSizeReached}
                            availableEnemies={props.availableEnemies}
                            availableModifiers={props.availableModifiers}
                />;
    });
    function remove(id){
        let temp = inputs.filter(input=>input !== id);
        setInputs(temp);
    }
    function toBattle(event){
        event.preventDefault();
        let enemyInputs = [...document.querySelectorAll('.enemy')];

        let dataToSend = enemyInputs.map(enemyInput=>{
            let select = enemyInput.querySelector("select[name='enemyName']");
            let selectedOption = select.options[select.selectedIndex].value;
            let selectModifier = enemyInput.querySelector("select[name='enemyModifier']");
            let selectedModifier = selectModifier.options[selectModifier.selectedIndex].value;
            let enemy ={
                name: selectedOption,
                count:enemyInput.querySelector("input[name='enemyCount']").value,
                modifier: selectedModifier
            }
            return enemy;
        });
        axios.post('/arena',dataToSend)
            .then(function (response) {
                // handle success
                // let spans = response.find('span');
                console.log(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }
    return (
        <div>
            <h1>Pick your enemies</h1>
            <form method="post">
                <div>
                {Inputs}
                <input type="submit" value="Start Battle" onClick={(event)=>toBattle(event)} />
                </div>
            </form>
        </div>
    )
}

export default PickEnemiesForm