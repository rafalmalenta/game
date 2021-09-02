import React, {useState} from 'react';
import PickEnemiesForm from './components/PickEnemiesForm';
import BattleReport from './components/BattleReport';

const Arena = (prop) => {
    const [reportArrived, setReport] = useState(false);
    if(reportArrived)
        return <BattleReport />
    else return <PickEnemiesForm availableEnemies={prop.availableEnemies} availableModifiers={prop.availableModifiers} />
}

export default Arena