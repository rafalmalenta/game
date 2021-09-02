import React from 'react';


const EnemyInput = (props) => {

    let removeMe = "";
    let addMore = "";
    if(!props.alone){
        removeMe = <input type="button" value="Remove me" onClick={()=>props.removeMe(props.id)}/>
    }
    if(!props.maxReached){
        addMore = <input type="button" value="Add Enemy" onClick={()=>props.addInput()}/>
    }
    let enemies = props.availableEnemies.map((enemy)=>{
        return <option key={enemy.name} value={enemy.name}>{enemy.name} level: {enemy.lvl}</option>
    });

    let modifiers = props.availableModifiers.map((modifier)=>{
        return <option key={modifier.name} value={modifier.name}>{modifier.name} </option>
        // modifier.boosts.map((boost)=>{

        // })
        // return <option key={modifier.name} value={enemy.name}>{enemy.name} level: {enemy.lvl}</option>
    });

    return (
        <div className="enemy">
            {removeMe}
            <select name={"enemyModifier"} id={props.id}>
                {modifiers}
            </select>
            <select name={"enemyName"} id={props.id}>
                {enemies}
            </select>
            <input name={"enemyCount"} defaultValue={1} type="number" max="25" min="1"/>
            {addMore}
            {/*todo Full selected enemy info*/}
        </div>
    )
}

export default EnemyInput