import React from 'react';
import ReactDOM from 'react-dom';
import Arena from './Arena';
import './arena.css';

let availableEnemies = Window.availableEnemies;
let availableModifiers = Window.availableModifiers;
ReactDOM.render(
    <React.StrictMode>
        <Arena availableEnemies={availableEnemies} availableModifiers={availableModifiers}/>
    </React.StrictMode>,
    document.getElementById('arena')
);

